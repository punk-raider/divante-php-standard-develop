<?php

namespace App\Command;

use App\Exception\InvalidParserException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Supplier\FactoryInterface as SupplierFactoryInterface;

class SupplierSyncCommand extends Command
{
    protected static $defaultName = 'divante:supplier-sync';

    private SupplierFactoryInterface $supplierFactory;

    public function __construct(SupplierFactoryInterface $supplierFactory)
    {
        parent::__construct(self::$defaultName);

        $this->supplierFactory = $supplierFactory;
    }

    protected function configure(): void
    {
        $this->setDescription('Synchronises a given supplier')
            ->addArgument(
                'supplier',
                InputArgument::REQUIRED,
                'Which supplier do you want to synchronize?'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $name = $input->getArgument('supplier');
        assert(is_string($name));

        $io->info('Synchronising supplier ' . $name);

        try {
            $supplier = $this->supplierFactory->getSupplier($name);
            $products = $supplier->getProducts();

            $table = new Table($output);
            $table->setHeaders(array('ID', 'Name', 'Desc'))->setRows($products);
            $table->render();
        } catch (\RuntimeException | \DomainException $exception) {
            $output->writeln('<error>' . $exception->getMessage() . '</error>');

            return Command::FAILURE;
        }

        $io->success('Done!');

        return Command::SUCCESS;
    }
}
