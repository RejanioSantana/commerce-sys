<div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> 
                            <!-- <span>
                                <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                            </span> -->
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{auth()->user()->First_Name}} {{auth()->user()->Last_Name}}</strong>
                             <!-- </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a> -->
                        <!-- <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="mailbox.html">Mailbox</a></li>
                            <li class="divider"></li>
                            <li><a href="login.html">Logout</a></li>
                        </ul> -->
                    </div>
                    <div class="logo-element">
                        TS+
                    </div>
                </li>
                <li>
                    <a href="{{route("home")}}"><i class="fa fa-circle"></i> <span class="nav-label">Home</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-arrow-circle-right"></i> <span class="nav-label">Venda</span></a>
                </li>
              
                <li>
                    <a href="#"><i class="fa fa-circle-o"></i> <span class="nav-label">Estoque</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="#">Pesquisar Produto</a></li>
                        <li><a href="{{route('product')}}">Novo Produto</a></li>
                        <li><a href="#">Devolução</a></li>
                        <li><a href="#">Status</a></li>
                        <li><a href="#">Relatorio</a></li>
                        <li><a href="#">Categorias</a></li>
                        <li><a href="{{route('unit')}}">Unidades</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-circle-o"></i> <span class="nav-label">Caixa</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="#">Livro Caixa</a></li>
                        <li><a href="#">Lançar Receita</a></li>
                        <li><a href="#">Lançar Despesa</a></li>
                        <li><a href="#">Gráficos</a></li>
                   
                    </ul>
                </li>

            </ul>

        </div>