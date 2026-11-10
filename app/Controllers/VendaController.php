<?php
class VendaController {
    public function __construct(private PDO $db, private ProdutoRepository $produtos, private ClienteRepository $clientes, private VendaRepository $vendas) {}
    public function index(): void { $produtos=$this->produtos->todos(); $clientes=$this->clientes->todos(); $titulo='Nova venda'; require __DIR__.'/../Views/vendas/index.php'; }
    public function finalizar(): void {
        $ids=$_POST['produto_id']??[]; $qtds=$_POST['quantidade']??[]; $itens=[]; $bruto=0;
        foreach($ids as $k=>$id){ $p=$this->produtos->buscar((int)$id); $q=(int)($qtds[$k]??0); if(!$p||$q<1) continue; if($q>(int)$p['estoque']) throw new RuntimeException('Quantidade maior que o estoque de '.$p['nome']); $sub=$q*(float)$p['preco']; $itens[]=['id'=>(int)$p['id'],'nome'=>$p['nome'],'quantidade'=>$q,'preco'=>(float)$p['preco'],'subtotal'=>$sub]; $bruto+=$sub; }
        if(!$itens) throw new RuntimeException('Adicione pelo menos um produto à venda.');
        $tipo=$_POST['pagamento']??'cartao'; $strategy=PaymentFactory::create($tipo); $total=$strategy->calcular($bruto); $cliente=($_POST['cliente_id']??'')!==''?(int)$_POST['cliente_id']:null;
        $id=$this->vendas->registrar($cliente,$itens,$strategy->nome(),$total); flash('Venda #'.$id.' registrada. Total: '.money($total)); redirect('?pagina=relatorios');
    }
}
