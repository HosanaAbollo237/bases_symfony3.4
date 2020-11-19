<?php

namespace CarBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;
use Doctrine\ORM\EntityManager;
use CarBundle\Service\DataChecker;

class AbcCheckCarsCommand extends Command
{

    /**
    *@var DataChecker
    *
    */
    protected $carChecker;

    /**
    *@var EntityManager
    *
    */
    protected $manager; // doctrine entityManager

    public function __construct(Datachecker $carChecker, EntityManager $manager){
        $this->carChecker = $carChecker;
        $this->manager = $manager;
        parent::__construct();
    }


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
            
        // Récupérer l'entité Car
        $carRepository = $this->manager->getRepository('CarBundle:Car');
        
        // Query tt les cars
        $cars = $carRepository->findAll();

        // instance de notre bar de progression
        // 1er param output object , 2eme param : nb elem on the loop
        $bar = new ProgressBar($output, count($cars));

        $argument = $input->getArgument('format'); // recuperation de l'argument 'format' (cf methode configure())
        $bar->setFormat($argument); // appliquer l'argument 'format' a notre bar
        $bar->start();

        foreach($cars as $car) {
            $this->carChecker->checkCar($car);
            sleep(1); // cheat pour simulation progression
            $bar->advance(); 
        }
        $bar->finish(); // fin bar de progression

    }

}
