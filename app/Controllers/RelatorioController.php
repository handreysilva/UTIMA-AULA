<?php
class RelatorioController {
    public function __construct(private VendaRepository $repo) {}
    public function index(): void { $vendas=$this->repo->todas(); $resumo=$this->repo->resumo(); $report=ReportFactory::create('vendas')->format($vendas); $titulo='Relatórios'; require __DIR__.'/../Views/relatorios/index.php'; }
}
