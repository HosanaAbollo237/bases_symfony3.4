<?php

namespace CarBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;

class AbcCheckCarsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('abc:check-cars')
            ->setDescription('...')
            ->addArgument('format', InputArgument::OPTIONAL, 'Progress format')
            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //doctrine manager : get('nameOfTheService')
        // Depuis notre entityManager, il nous faut le carRepo
        $manager =$this->getContainer()->get('doctrine.orm.entity_manager');
        $dataChecker = $this->getCOntainer()->get('car.data_checker');
        
        // Récupérer l'entité Car
        $carRepository = $manager->getRepository('CarBundle:Car');
        
        // Query tt les cars
        $cars = $carRepository->findAll();

        // instance de notre bar de progression
        // 1er param output object , 2eme param : nb elem on the loop
        $bar = new ProgressBar($output, count($cars));

        $argument = $input->getArgument('format'); // recuperation de l'argument 'format' (cf methode configure())
        $bar->setFormat($argument); // appliquer l'argument 'format' a notre bar
        $bar->start();

        foreach($cars as $car) {
            $dataChecker->checkCar($car);
            sleep(1); // cheat pour simulation progression
            $bar->advance(); 
        }
        $bar->finish(); // fin bar de progression

    }

}
