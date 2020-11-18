<?php

namespace CarBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AbcCheckCarsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('abc:check-cars')
            ->setDescription('...')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //doctrine manager : get('nameOfTheService')
        // Depuis notre entityManager, il nous faut le carRepo
        $manager =$this->getContainer()->get('doctrine.orm.entity_manager');
        // Récupérer l'entité Car
        $carRepository = $manager->getRepository('CarBundle:Car');
        // Query tt les cars
        $cars = $carRepository->findAll();

        // Iterer pour afficher l'id des cars
        foreach($cars as $car) {
            $output->writeln($car->getId());
        }

    }

}
