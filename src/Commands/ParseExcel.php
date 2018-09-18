<?php

namespace App\Commands;

use App\Core\Connection;
use App\Core\ReadExcel;
use App\Repository\BoxRepository;
use App\Repository\ShipmentBoxRepository;
use App\Repository\ShipmentRepository;
use App\Services\BoxService;
use App\Services\ParseService;
use App\Services\ShipmentBoxService;
use App\Services\ShipmentService;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ParseExcel extends Command
{
    const EXCEL_PATH = __DIR__ . '/../../files/';
    const CONFIG_PATH = __DIR__ . '/../../configuration/mysql.yml';

    protected function configure()
    {
        $this
            ->setName('make:parse')
            ->setDescription('Parses the Excel file and save it to the database.')
            ->setHelp('This command run to parse excel file with save it in the database')
            ->addArgument(
                'filename',
                InputArgument::REQUIRED,
                'Enter filename with the extension'
            );;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Start of parse excel file',
            '=========================',
        ]);

        try {
            $fileName = $input->getArgument('filename');
            $this->checkFile($fileName);

            $connect = new Connection(self::CONFIG_PATH);

            $excel = new ReadExcel(self::EXCEL_PATH . $fileName);
            $parseService = new ParseService();
            $parseService->parseArray($excel->read());

            $shipService = new ShipmentService(new ShipmentRepository($connect->getConnect()));
            $shipService->save($parseService->getShipments());

            $boxService = new BoxService(new BoxRepository($connect->getConnect()));
            $boxService->save($parseService->getBoxes());

            $shipBoxService = new ShipmentBoxService(new ShipmentBoxRepository($connect->getConnect()));
            $shipBoxService->save($parseService->getShipmentsBoxes());

            $output->writeln('Successfully');

        } catch (Exception $e) {
            $output->writeln(sprintf("ERROR! %s", $e->getMessage()));
        }
    }

    /**
     * @param string $fileName
     *
     * @return bool
     *
     * @throws Exception
     */
    protected function checkFile(string $fileName): bool
    {
        if (empty($fileName))
            throw new Exception('No filename received.');

        if (!file_exists(self::EXCEL_PATH . $fileName))
            throw new Exception("Configuration file not found");

        return true;
    }

}