<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venda de Produtos</title>
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">


    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <style>
        body {
            background-color: #2f4050;
            color: #ffffff;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh; /* Ocupa 100% da altura da tela */
        }
        header {
            background-color: #4b0082;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header .logo {
            font-size: 24px;
            font-weight: bold;
        }
        header .links a {
            color: white;
            margin-left: 15px;
            text-decoration: none;
        }
        header .links a:hover {
            text-decoration: underline;
        }
        .container {
            max-width: 900px;
            background: white;
            color: black;
            padding: 20px;
            border-radius: 0; /* Cantos retos */
            margin: 20px auto;
            flex: 1; /* Expande para ocupar o espaço disponível */
            display: flex;
            flex-direction: column;
        }
        .btn-adicionar {
            background-color: #6a0dad;
            color: white;
        }
        .btn-finalizar {
            background-color: green;
            color: white;
        }
        .modal-content {
            background: white;
            color: black;
        }
        input[type="number"] {
            width: 60px;
            text-align: center;
        }
        .cpf-field {
            display: none; /* Esconde o campo CPF inicialmente */
            margin-top: 10px;
        }
        h2 {
            text-align: center;
            color: white;
            margin-top: 20px;
        }
        .pesquisa-container {
            width: 100%; /* Barra de pesquisa ocupa 100% da largura */
        }
        footer {
            background-color: #4b0082;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .tabela-container {
            max-height: 300px; /* Altura máxima da tabela */
            overflow-y: auto; /* Adiciona barra de rolagem vertical */
            margin-bottom: 20px; /* Espaço entre a tabela e o total */
        }
        .tabela-container table {
            margin-bottom: 0; /* Remove margem inferior padrão da tabela */
        }
        .total-container {
            margin-top: auto; /* Empurra o total e o botão para perto do footer */
            text-align: right;
            margin-bottom: 2vh;
        }
        .desconto-info {
            color: red; /* Cor para destacar o desconto */
            font-weight: bold;
        }
    </style>

    <script>
        // Função para entrar no modo de tela cheia
        function entrarModoTelaCheia() {
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen();
            } else if (document.documentElement.mozRequestFullScreen) { // Firefox
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullscreen) { // Chrome, Safari e Opera
                document.documentElement.webkitRequestFullscreen();
            } else if (document.documentElement.msRequestFullscreen) { // IE/Edge
                document.documentElement.msRequestFullscreen();
            }
        }

        // Função para sair do modo de tela cheia
        function sairModoTelaCheia() {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) { // Firefox
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) { // Chrome, Safari e Opera
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) { // IE/Edge
                document.msExitFullscreen();
            }
        }

        // Entrar no modo de tela cheia ao carregar a página
        document.addEventListener("DOMContentLoaded", function() {
            entrarModoTelaCheia();

            const pesquisaInput = document.getElementById("pesquisa");
            pesquisaInput.focus();
            
            document.addEventListener("keydown", function(event) {
                if (event.key === "F8") {
                    event.preventDefault();
                    // aplicarDesconto();
                }
                if (event.key === "Escape") {
                    sairModoTelaCheia();
                }
            });

            // Impede o envio do formulário
            document.getElementById("form-sale").addEventListener("submit", function(event) {
            event.preventDefault(); 
            });

            // Carregando a logica dos clientes
            const radios = document.querySelectorAll("input[name='typeSale']");
            const localeSelect = document.getElementById("selectClient");
            const selectClient = document.getElementById("idClient");
        
            radios.forEach(radio => {
                radio.addEventListener("change", function () {
                    localeSelect.style.display = this.value === "2" ? "block" : "none";
                });
            });

            fetch("{{ route('search.client') }}",{
                method: 'Get',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Adicionar o token CSRF para segurança
                },
            }) // Substitua pela URL correta da API
            .then(response => response.json())
            .then(data => {
                    selectClient.innerHTML = '<option value="">Selecione um cliente</option>';
                    data.data.forEach(cliente => {
                        if(cliente.id === 1){
                            return;
                        }
                        selectClient.innerHTML += `<option value="${cliente.id}">${cliente.First_Name}</option>`;
                });
            })
             .catch(error => console.error("Erro ao carregar clientes:", error));


        });        

        function fecharModal() {
            document.getElementById("modalCodigoBarras").style.display = "none";
        }
        
        function pesquisarProduto() {
            let termo = document.getElementById("pesquisa").value;
            if (termo.length >= 3) {
                // Gerar a URL da rota 'sale.index' com o termo de pesquisa como parâmetro de consulta
                const url = "{{ route('sale.search') }}";

                // Enviar a requisição GET para a rota 'sale.index'
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Adicionar o token CSRF para segurança
                    },
                    body: JSON.stringify({termo: termo})
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro na requisição');
                    }
                    return response.json();
                })
                .then(data => {
                    let resultados = document.getElementById("resultadosPesquisa");
                    resultados.innerHTML = "";
                    if(data.dados.length != 0){
                        data.dados.forEach(data => {
                           resultados.innerHTML += `<li class='list-group-item' onclick='adicionarAoCarrinho(${JSON.stringify(data)})'>${data.Name_Product} - R$ ${data.Sale_Value}</li>`;
                        });
                        
                    }else{
                        resultados.innerHTML += `<li class='list-group-item'>Nenhum item encontrado.</li>`;
                    }
                 })
                .catch(error => console.error('Error:', error));
    
            }else{
                let resultados = document.getElementById("resultadosPesquisa");
                resultados.innerHTML = "";
            }
        }

        function adicionarAoCarrinho(produto) {
            let quantidade = 1;
            let carrinho = document.getElementById("carrinho");
            let linhas = carrinho.getElementsByTagName("tr");
            let encontrado = false;
            let dadosCarrinho = [];

            // Percorre as linhas para verificar se o produto já existe no carrinho
            for (let i = 0; i < linhas.length; i++) {
                let celulas = linhas[i].getElementsByTagName("td");
                
                let  inputp = celulas[3].children[0].name;
                let  idc = inputp.match(/\d+/)[0];
                let nomeProduto = celulas[1].innerText;
                let valorProduto = parseFloat(celulas[2].innerText.replace("R$ ", ""));
                let quantidadeProduto = parseInt(celulas[3].getElementsByTagName("input")[0].value);
                
                if (nomeProduto === produto.Name_Product) { 
                    // Produto já existe no carrinho, aumentar quantidade
                    quantidadeProduto += 1;
                    celulas[3].getElementsByTagName("input")[0].value = quantidadeProduto;

                    // Atualizar subtotal
                    let novoSubtotal = quantidadeProduto * valorProduto;
                    celulas[4].innerText = `R$ ${novoSubtotal.toFixed(2)}`;

                    encontrado = true;
                }
                
                // Salva os dados existentes
                dadosCarrinho.push({
                    id: idc,
                    codigo: celulas[0].innerText,
                    nome: nomeProduto,
                    preco: valorProduto,
                    quantidade: quantidadeProduto,
                    subtotal: quantidadeProduto * valorProduto
                });
            }

            if (!encontrado) {
                // Adiciona o novo produto ao array antes de recriar a tabela
                dadosCarrinho.push({
                    id: produto.id,
                    codigo: produto.Cod_Product,
                    nome: produto.Name_Product,
                    preco: parseFloat(produto.Sale_Value),
                    quantidade: quantidade,
                    subtotal: parseFloat(produto.Sale_Value) * quantidade
                });
            }

            // Limpa a tabela e recria as linhas com os dados armazenados
            carrinho.innerHTML = "";
            dadosCarrinho.forEach(item => {
                let row = `<tr>
                                <td>${item.codigo}</td>
                                <td>${item.nome}</td>
                                <td>R$ ${item.preco.toFixed(2)}</td>
                                <td><input type="number" name="product[${item.id}]" value="${item.quantidade}" min="1" onchange="atualizarQuantidade(this, ${item.preco})"></td>
                                <td>R$ ${item.subtotal.toFixed(2)}</td>
                                <td><button class='btn btn-danger btn-sm' onclick='removerProduto(this)'>Remover</button></td>
                            </tr>`;
                carrinho.innerHTML += row;
            });

            atualizarTotal();
            limparPesquisa();
            // let quantidade = 1;
            // let carrinho = document.getElementById("carrinho");
            // let linhas = carrinho.getElementsByTagName("tr");
            // let encontrado = false;

            // for (let i = 0; i < linhas.length; i++) {
            //     let celulas = linhas[i].getElementsByTagName("td");
            //     if (celulas[1].innerText === produto.Name_Product) { 
            //         // Produto já existe no carrinho, aumentar quantidade
            //         let inputQuantidade = celulas[3].getElementsByTagName("input")[0];
            //         let novaQuantidade = parseInt(inputQuantidade.value) + 1;
            //         inputQuantidade.value = novaQuantidade;

            //         // Atualizar subtotal
            //         let novoSubtotal = novaQuantidade * parseFloat(produto.Sale_Value);
            //         celulas[4].innerText = `R$ ${novoSubtotal}`;

            //         encontrado = true;
            //         break;
            //     }
            // }

            // if (!encontrado) {
            //     // Produto não encontrado, adiciona nova linha
            //     let subtotal = parseFloat(produto.Sale_Value) * parseInt(quantidade);
            //     let row = `<tr>
            //                     <td>${produto.Cod_Product}</td>
            //                     <td>${produto.Name_Product}</td>
            //                     <td>R$ ${produto.Sale_Value}</td>
            //                     <td><input type="number" name="product[${produto.id}]" value="${quantidade}" min="1" onchange="atualizarQuantidade(this, ${produto.Sale_Value})"></td>
            //                     <td>R$ ${subtotal}</td>
            //                     <td><button class='btn btn-danger btn-sm' onclick='removerProduto(this)'>Remover</button></td>
            //                 </tr>`;
            //     carrinho.innerHTML += row;
            // }

            // atualizarTotal();
            // limparPesquisa();
        }

        function limparPesquisa()
        {
            let resultados = document.getElementById("resultadosPesquisa");
            resultados.innerHTML = "";
            let termo = document.getElementById("pesquisa").value = "";
        }
        
        function atualizarQuantidade(input, preco) {
            let quantidade = parseInt(input.value, 10);
            if (isNaN(quantidade) || quantidade < 1) {
                quantidade = 1;
                input.value = quantidade;
            }
            
            let linha = input.parentElement.parentElement;
            let totalItem = quantidade * preco;
            linha.querySelector("td:nth-child(5)").innerText = `R$ ${totalItem.toFixed(2)}`;
            atualizarTotal();
            return
        }
        
        function atualizarTotal() {
            let totalElement = document.getElementById("total");
            let desconto = document.getElementById("desconto").innerHTML;    
            let linhas = document.querySelectorAll("#carrinho tr");
            let total = 0;
            
            linhas.forEach(linha => {
                let totalItem = parseFloat(linha.querySelector("td:nth-child(5)").innerText.replace("R$ ", ""));
                total += totalItem;
            });
            valorTotal = parseFloat(total) - parseFloat(desconto);
            totalElement.innerText = valorTotal.toFixed(2) ;
            
            return
        }
        function retornarTotal() {

            let linhas = document.querySelectorAll("#carrinho tr");
            let total = 0;
            
            linhas.forEach(linha => {
                let totalItem = parseFloat(linha.querySelector("td:nth-child(5)").innerText.replace("R$ ", ""));
                total += totalItem;
            });
            
            return total.toFixed(2);
        }
        
        function removerProduto(botao, subtotal) {
            
            botao.parentElement.parentElement.remove();
            atualizarTotal();
        }

        function abrirModalFinalizar() {
            document.getElementById("modalFinalizar").style.display = "block";
        }
        function abrirModalQuantidade() {
            document.getElementById("modalQuantidade").style.display = "block";
        }

        function fecharModalFinalizar() {
            document.getElementById("modalFinalizar").style.display = "none";
        }

        function toggleCPFField(resposta) {
            const cpfField = document.getElementById("cpfField");
            if (resposta === "sim") {
                cpfField.style.display = "block"; // Mostra o campo CPF
            } else {
                cpfField.style.display = "none"; // Esconde o campo CPF
            }
        }

        function finalizarVenda() {
            const nfsCPF = document.querySelector('input[name="nfsCPF"]:checked').value;
            const cpf = document.getElementById("cpf").value;

            if (nfsCPF === "sim" && !cpf) {
                alert("Por favor, insira o CPF do comprador.");
                return;
            }

            
            fecharModalFinalizar();
            document.getElementById("form-sale").submit();
        }

        function aplicarDesconto() {
            let desconto = parseFloat(prompt("Informe o valor do desconto (em reais):"));
            if (isNaN(desconto) || desconto < 0) {
                alert("Desconto inválido!");
                return;
            }

            let totalComDesconto = parseFloat(retornarTotal()) - parseFloat(desconto);

            if (totalComDesconto < 0) {
                alert("O desconto não pode ser maior que o total.");
                return;
            }

            // Exibe o desconto aplicado
            
            let descontoInfo = document.getElementById("desconto");    
            let discountInput = document.getElementById("discount");
            descontoInfo.innerText = desconto.toFixed(2);
            discountInput.value = desconto.toFixed(2);
            // Atualiza o total com o desconto
            atualizarTotal();

        }

    </script>
</head>
<body >
    <header>
        <div class="logo">TotalSale</div>
        <div class="links">
            <a href="{{ route('home') }}#}">Painel</a>
            <a href="{{ route('logout') }}">Sair</a>
        </div>
    </header>

    <h2>Venda</h2> <!-- Título fora da div e centralizado -->
    <div class="container">
        @include('sale.message')
        <div class="row">
            <div class="col-md-12 pesquisa-container"> <!-- Barra de pesquisa com 100% de largura -->
                <div class="mb-3">
                    <label for="pesquisa" class="form-label">Pesquisar Item</label>
                    <input type="text" id="pesquisa" class="form-control" onkeyup="pesquisarProduto()" placeholder="Nome do item ou codigo de barra.">
                    <ul id="resultadosPesquisa" class="list-group mt-2"></ul>
                </div>
            </div>
        </div>
        <hr>
        <form action="{{ route('sale.store') }}" method="post" id="form-sale">
            @csrf
        <h4>Itens no Carrinho</h4>
        <div class="tabela-container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Cod</th>
                        <th>Item</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Total</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody id="carrinho">
                    
                </tbody>
            </table>
        </div>
        <div class="total-container">
            <div id="descontoInfo" class="desconto-info">
                <input type="hidden" name="discount" id="discount">
                <div id="descontoInfo" class="descontoInfo">Desconto: R$ <span id="desconto">0.00</span></div>
            </div> <!-- Local para exibir o desconto -->
            <h3>Total: R$ <span id="total"></span></h3>
            <button class="btn btn-finalizar" onclick="abrirModalFinalizar()">Finalizar Venda</button>
        </div>
    </div>
    
    <!-- Footer com dicas de atalhos -->
    <footer>
        <div> F8 - Aplicar Desconto | F11 - Tela Cheia</div>
    </footer>

    <!-- Modal de Finalização -->
    <div id="modalFinalizar" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5);">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Finalizar Venda</h5>
                    <button type="button" class="btn-close" onclick="fecharModalFinalizar()"></button>
                </div>
                <div class="modal-body">

                    <div>
                        <p>Nota fiscal com CPF?</p>
                        <label class="col-sm-6">
                            <input type="radio" name="nfsCPF" value="sim" onclick="toggleCPFField('sim')"> Sim
                        </label>
                        <label class="col-sm-6">
                            <input type="radio" name="nfsCPF" value="nao" onclick="toggleCPFField('nao')" checked required> Não
                        </label>
                        <div id="cpfField" class="cpf-field col-10-sm">
                            <label for="cpf">CPF do Comprador:</label>
                            <input type="text" id="cpf" name="cpf" class="form-control" placeholder="Digite o CPF">
                        </div>
                    </div>

                    <br>

                    <div class="col-12-sm form-group">
                    <div class="row">
                        <p>Tipo de Venda:</p>
                        
                        <div>
                            <label><input type="radio" name="typeSale" value="1" checked> Venda Padrão</label>
                        </div>
                        <div>
                            <label><input type="radio" name="typeSale" value="2"> Cliente</label>
                        </div>
                        
                        <div id="selectClient" class="cpf-field col-10-sm" style="display: none;">
                            <label for="idClient">Selecione o cliente: </label>
                            <select name="idClient" id="idClient">
                                <option value="">Selecione um cliente</option>
                            </select>
                            <div class="row ">
                                <label for="">
                                    Pagamento
                                    <input type="text" name="payClient" pattern="^[0-9]+(\.[0-9]+)?$" maxlength="8" >
                                </label>
                            </div>
                        </div>
                    </div>
                        

                </div>

            </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" onclick="fecharModalFinalizar()">Cancelar</button>
                    <button class="btn btn-finalizar" onclick="finalizarVenda()">Confirmar</button>
                </div>

            </div>
        </div>
    </div>

    
    </form>




</body>
</html>