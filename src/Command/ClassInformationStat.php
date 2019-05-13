<?php

/*
 * This file is part of the "PHP Static Analyzer" project.
 *
 * (c) Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Greeflas\StaticAnalyzer\Command;

use Greeflas\StaticAnalyzer\Analyzer\ClassInformation;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

/**
 * The command to get information about the class name, type, number of methods and properties that are in this class
 *
 * Example of usage
 * ./bin/console stat:class-information <class name>
 *
 * @author Kubrak Anton <ljustpewpewl@gmail.com>
 */
class ClassInformationStat extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('stat:class-information')
            ->setDescription('Get information about class')
            ->addArgument(
                'class-name',
                InputArgument::REQUIRED,
                'class name'
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $class = $input->getArgument('class-name');
        $analyzer = new ClassInformation($class);
        $result = $analyzer->analyze();

        foreach ($result as $i => $item) {
            $output->writeln(\sprintf('<comment>%s- %s</comment>', $i, $item));
        }
    }
}
