<?php
/**
 * @license MIT
 *
 * Modified by bracketspace on 17-February-2025 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types=1);

/*
 * This file is part of Composer.
 *
 * (c) Nils Adermann <naderman@naderman.de>
 *     Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BracketSpace\Notification\Dependencies\Composer\Command;

use BracketSpace\Notification\Dependencies\Composer\Repository\PlatformRepository;
use BracketSpace\Notification\Dependencies\Composer\Repository\RootPackageRepository;
use BracketSpace\Notification\Dependencies\Composer\Repository\InstalledRepository;
use BracketSpace\Notification\Dependencies\Composer\Installer\SuggestedPackagesReporter;
use BracketSpace\Notification\Dependencies\Composer\Console\Input\InputArgument;
use BracketSpace\Notification\Dependencies\Symfony\Component\Console\Input\InputInterface;
use BracketSpace\Notification\Dependencies\Composer\Console\Input\InputOption;
use BracketSpace\Notification\Dependencies\Symfony\Component\Console\Output\OutputInterface;

class SuggestsCommand extends BaseCommand
{
    use CompletionTrait;

    protected function configure(): void
    {
        $this
            ->setName('suggests')
            ->setDescription('Shows package suggestions')
            ->setDefinition([
                new InputOption('by-package', null, InputOption::VALUE_NONE, 'Groups output by suggesting package (default)'),
                new InputOption('by-suggestion', null, InputOption::VALUE_NONE, 'Groups output by suggested package'),
                new InputOption('all', 'a', InputOption::VALUE_NONE, 'Show suggestions from all dependencies, including transitive ones'),
                new InputOption('list', null, InputOption::VALUE_NONE, 'Show only list of suggested package names'),
                new InputOption('no-dev', null, InputOption::VALUE_NONE, 'Exclude suggestions from require-dev packages'),
                new InputArgument('packages', InputArgument::IS_ARRAY | InputArgument::OPTIONAL, 'Packages that you want to list suggestions from.', null, $this->suggestInstalledPackage()),
            ])
            ->setHelp(
                <<<EOT

The <info>%command.name%</info> command shows a sorted list of suggested packages.

Read more at https://getcomposer.org/doc/03-cli.md#suggests
EOT
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $composer = $this->requireComposer();

        $installedRepos = [
            new RootPackageRepository(clone $composer->getPackage()),
        ];

        $locker = $composer->getLocker();
        if ($locker->isLocked()) {
            $installedRepos[] = new PlatformRepository([], $locker->getPlatformOverrides());
            $installedRepos[] = $locker->getLockedRepository(!$input->getOption('no-dev'));
        } else {
            $installedRepos[] = new PlatformRepository([], $composer->getConfig()->get('platform'));
            $installedRepos[] = $composer->getRepositoryManager()->getLocalRepository();
        }

        $installedRepo = new InstalledRepository($installedRepos);
        $reporter = new SuggestedPackagesReporter($this->getIO());

        $filter = $input->getArgument('packages');
        $packages = $installedRepo->getPackages();
        $packages[] = $composer->getPackage();
        foreach ($packages as $package) {
            if (!empty($filter) && !in_array($package->getName(), $filter)) {
                continue;
            }

            $reporter->addSuggestionsFromPackage($package);
        }

        // Determine output mode, default is by-package
        $mode = SuggestedPackagesReporter::MODE_BY_PACKAGE;

        // if by-suggestion is given we override the default
        if ($input->getOption('by-suggestion')) {
            $mode = SuggestedPackagesReporter::MODE_BY_SUGGESTION;
        }
        // unless by-package is also present then we enable both
        if ($input->getOption('by-package')) {
            $mode |= SuggestedPackagesReporter::MODE_BY_PACKAGE;
        }
        // list is exclusive and overrides everything else
        if ($input->getOption('list')) {
            $mode = SuggestedPackagesReporter::MODE_LIST;
        }

        $reporter->output($mode, $installedRepo, empty($filter) && !$input->getOption('all') ? $composer->getPackage() : null);

        return 0;
    }
}
