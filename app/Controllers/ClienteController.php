<?php
class ClienteController {
    public function __construct(private ClienteRepository $repo) {}
    public function index(): void { $clientes=$this->repo->todos(); $edit=isset($_GET['editar'])?$this->repo->buscar((int)$_GET['editar']):null; $titulo='Clientes'; require __DIR__.'/../Views/clientes/index.php'; }
    public function salvar(): void {
        $d=$this->dados(); if(!$d['nome']) throw new RuntimeException('Informe o nome do cliente.');
        if(!empty($_POST['id'])) $this->repo->atualizar((int)$_POST['id'],$d); else $this->repo->salvar($d);
        flash('Cliente salvo com sucesso.'); redirect('?pagina=clientes');
    }
    public function excluir(): void { $this->repo->excluir((int)$_POST['id']); flash('Cliente excluído.'); redirect('?pagina=clientes'); }
    private function dados(): array { return ['nome'=>trim($_POST['nome']??''),'cpf'=>trim($_POST['cpf']??''),'telefone'=>trim($_POST['telefone']??''),'email'=>trim($_POST['email']??'')]; }
}
