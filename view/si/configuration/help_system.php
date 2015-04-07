<?php
// Route view
$route = isset($_GET["page"]) ? $_GET["page"] : "";
$_SESSION["active_option_menu"] = $route;
$routeFull = $route . "&cf_jscss[0]=datatable&ci_jq[0]=datatable_index&ci_js[0]=messages";
?>   

<div class="page-title">
    <div class="title-env">
        <h1 class="title"><i class="fa fa-question-circle"></i> Ayuda del sistema</h1>
        <p class="description">En esta p&aacute;gina se muestra la ayuda necesaria para operar el sistema.</p>
    </div>

    <div class="breadcrumb-env">
        <ol class="breadcrumb bc-1">
            <li>
                <a href="index.php"><i class="fa-home"></i>Inicio</a>
            </li>
            <li class="active">
                <strong>Ayuda del sistema</strong>
            </li>
        </ol>
    </div>
</div>  
<!-- Contenido -->
<div class="row">
    <div class="col-sm-12">


        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Ayuda del Sistema</h3>

                <div class="panel-options">

                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab-1" data-toggle="tab">Administrador</a>
                        </li>
                        <li>
                            <a href="#tab-2" data-toggle="tab">Facturacion</a>
                        </li>
                        <li>
                            <a href="#tab-3" data-toggle="tab">Clientes</a>
                        </li>                        
                        <li>
                            <a href="#tab-4" data-toggle="tab">Almacen</a>
                        </li>
                        <li>
                            <a href="#tab-5" data-toggle="tab">Compras</a>
                        </li>
                        <li>
                            <a href="#tab-6" data-toggle="tab">Proveedores</a>
                        </li>                                                
                        <li>
                            <a href="#tab-7" data-toggle="tab">Bancarizacion</a>
                        </li>
                        <li>
                            <a href="#tab-8" data-toggle="tab">Reportes</a>
                        </li>                        
                        <li>
                            <a href="#tab-9" data-toggle="tab">Seguridad</a>
                        </li>                                                
                    </ul>

                </div>
            </div>

            <div class="panel-body">

                <div class="tab-content">

                    <div class="tab-pane active" id="tab-1">
                        <p class="text-center"><strong>Ayuda para el Administrador</strong>  </p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc et convallis nisl. Etiam ultrices, risus quis commodo commodo, est erat malesuada ligula, quis scelerisque nulla nibh vel ipsum. Pellentesque at euismod risus. Phasellus lacus nisi, hendrerit non ex congue, maximus ullamcorper tortor. Donec sodales diam sed velit tristique feugiat. Sed viverra nec massa sit amet maximus. Nam nec tortor quis dui faucibus imperdiet ut quis magna. Phasellus aliquam lorem in consequat rhoncus. Proin vel ornare lacus. Etiam et luctus sapien. Sed a arcu porttitor, sagittis diam sit amet, tristique neque. Nam rutrum ante vel sodales posuere. Maecenas dolor mi, consequat sed leo eget, congue convallis sem. Etiam est mi, ornare nec sollicitudin eget, venenatis et ante. Nam euismod nunc eu erat bibendum, nec venenatis sem sagittis.</p>
                        <p class="text-justify">Mauris ac malesuada orci. Nulla ac risus a dolor finibus molestie sed eget nibh. Maecenas porta nibh cursus, vehicula metus a, feugiat nulla. Suspendisse id accumsan nunc, et dictum ex. Nullam eget posuere tellus. Nunc massa nunc, pharetra sit amet purus sit amet, commodo dictum arcu. Nullam eleifend ipsum nec mattis molestie. Cras aliquam vehicula dui vel porttitor. Nunc et ligula pulvinar purus porta elementum. Morbi luctus dolor tortor, eget dictum elit molestie sed. Aenean sit amet feugiat neque, quis tempor lacus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras tempor purus lorem, ut ultricies tortor elementum eu. Proin a augue felis.</p>
                        <br/>
                        <p class="text-right">
                            <a href="#" onclick="print();" class="btn btn-warning btn-icon btn-icon-standalone">
                                <i class="fa fa-print"></i>
                                <span>Imprimir</span>
                            </a>
                        </p> 
                    </div>
                    <div class="tab-pane" id="tab-2">
                        <p class="text-center"><strong>Ayuda para quien Factura</strong>  </p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc et convallis nisl. Etiam ultrices, risus quis commodo commodo, est erat malesuada ligula, quis scelerisque nulla nibh vel ipsum. Pellentesque at euismod risus. Phasellus lacus nisi, hendrerit non ex congue, maximus ullamcorper tortor. Donec sodales diam sed velit tristique feugiat. Sed viverra nec massa sit amet maximus. Nam nec tortor quis dui faucibus imperdiet ut quis magna. Phasellus aliquam lorem in consequat rhoncus. Proin vel ornare lacus. Etiam et luctus sapien. Sed a arcu porttitor, sagittis diam sit amet, tristique neque. Nam rutrum ante vel sodales posuere. Maecenas dolor mi, consequat sed leo eget, congue convallis sem. Etiam est mi, ornare nec sollicitudin eget, venenatis et ante. Nam euismod nunc eu erat bibendum, nec venenatis sem sagittis.</p>
                        <p class="text-justify">Mauris ac malesuada orci. Nulla ac risus a dolor finibus molestie sed eget nibh. Maecenas porta nibh cursus, vehicula metus a, feugiat nulla. Suspendisse id accumsan nunc, et dictum ex. Nullam eget posuere tellus. Nunc massa nunc, pharetra sit amet purus sit amet, commodo dictum arcu. Nullam eleifend ipsum nec mattis molestie. Cras aliquam vehicula dui vel porttitor. Nunc et ligula pulvinar purus porta elementum. Morbi luctus dolor tortor, eget dictum elit molestie sed. Aenean sit amet feugiat neque, quis tempor lacus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras tempor purus lorem, ut ultricies tortor elementum eu. Proin a augue felis.</p>
                        <br/>
                        <p class="text-right">
                            <a href="#" onclick="print();" class="btn btn-warning btn-icon btn-icon-standalone">
                                <i class="fa fa-print"></i>
                                <span>Imprimir</span>
                            </a>
                        </p>                         
                    </div>
                    <div class="tab-pane" id="tab-3">
                        <p class="text-center"><strong>Ayuda para quien maneja los Clientes </strong>  </p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc et convallis nisl. Etiam ultrices, risus quis commodo commodo, est erat malesuada ligula, quis scelerisque nulla nibh vel ipsum. Pellentesque at euismod risus. Phasellus lacus nisi, hendrerit non ex congue, maximus ullamcorper tortor. Donec sodales diam sed velit tristique feugiat. Sed viverra nec massa sit amet maximus. Nam nec tortor quis dui faucibus imperdiet ut quis magna. Phasellus aliquam lorem in consequat rhoncus. Proin vel ornare lacus. Etiam et luctus sapien. Sed a arcu porttitor, sagittis diam sit amet, tristique neque. Nam rutrum ante vel sodales posuere. Maecenas dolor mi, consequat sed leo eget, congue convallis sem. Etiam est mi, ornare nec sollicitudin eget, venenatis et ante. Nam euismod nunc eu erat bibendum, nec venenatis sem sagittis.</p>
                        <p class="text-justify">Mauris ac malesuada orci. Nulla ac risus a dolor finibus molestie sed eget nibh. Maecenas porta nibh cursus, vehicula metus a, feugiat nulla. Suspendisse id accumsan nunc, et dictum ex. Nullam eget posuere tellus. Nunc massa nunc, pharetra sit amet purus sit amet, commodo dictum arcu. Nullam eleifend ipsum nec mattis molestie. Cras aliquam vehicula dui vel porttitor. Nunc et ligula pulvinar purus porta elementum. Morbi luctus dolor tortor, eget dictum elit molestie sed. Aenean sit amet feugiat neque, quis tempor lacus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras tempor purus lorem, ut ultricies tortor elementum eu. Proin a augue felis.</p>
                        <br/>
                        <p class="text-right">
                            <a href="#" onclick="print();" class="btn btn-warning btn-icon btn-icon-standalone">
                                <i class="fa fa-print"></i>
                                <span>Imprimir</span>
                            </a>
                        </p>                         
                    </div>
                    <div class="tab-pane" id="tab-4">
                        <p class="text-center"><strong>Ayuda para quien maneja el Almacen </strong>  </p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc et convallis nisl. Etiam ultrices, risus quis commodo commodo, est erat malesuada ligula, quis scelerisque nulla nibh vel ipsum. Pellentesque at euismod risus. Phasellus lacus nisi, hendrerit non ex congue, maximus ullamcorper tortor. Donec sodales diam sed velit tristique feugiat. Sed viverra nec massa sit amet maximus. Nam nec tortor quis dui faucibus imperdiet ut quis magna. Phasellus aliquam lorem in consequat rhoncus. Proin vel ornare lacus. Etiam et luctus sapien. Sed a arcu porttitor, sagittis diam sit amet, tristique neque. Nam rutrum ante vel sodales posuere. Maecenas dolor mi, consequat sed leo eget, congue convallis sem. Etiam est mi, ornare nec sollicitudin eget, venenatis et ante. Nam euismod nunc eu erat bibendum, nec venenatis sem sagittis.</p>
                        <p class="text-justify">Mauris ac malesuada orci. Nulla ac risus a dolor finibus molestie sed eget nibh. Maecenas porta nibh cursus, vehicula metus a, feugiat nulla. Suspendisse id accumsan nunc, et dictum ex. Nullam eget posuere tellus. Nunc massa nunc, pharetra sit amet purus sit amet, commodo dictum arcu. Nullam eleifend ipsum nec mattis molestie. Cras aliquam vehicula dui vel porttitor. Nunc et ligula pulvinar purus porta elementum. Morbi luctus dolor tortor, eget dictum elit molestie sed. Aenean sit amet feugiat neque, quis tempor lacus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras tempor purus lorem, ut ultricies tortor elementum eu. Proin a augue felis.</p>
                        <br/>
                        <p class="text-right">
                            <a href="#" onclick="print();" class="btn btn-warning btn-icon btn-icon-standalone">
                                <i class="fa fa-print"></i>
                                <span>Imprimir</span>
                            </a>
                        </p>                         
                    </div>
                    <div class="tab-pane" id="tab-5">
                        <p class="text-center"><strong>Ayuda para quien maneja las Compras </strong>  </p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc et convallis nisl. Etiam ultrices, risus quis commodo commodo, est erat malesuada ligula, quis scelerisque nulla nibh vel ipsum. Pellentesque at euismod risus. Phasellus lacus nisi, hendrerit non ex congue, maximus ullamcorper tortor. Donec sodales diam sed velit tristique feugiat. Sed viverra nec massa sit amet maximus. Nam nec tortor quis dui faucibus imperdiet ut quis magna. Phasellus aliquam lorem in consequat rhoncus. Proin vel ornare lacus. Etiam et luctus sapien. Sed a arcu porttitor, sagittis diam sit amet, tristique neque. Nam rutrum ante vel sodales posuere. Maecenas dolor mi, consequat sed leo eget, congue convallis sem. Etiam est mi, ornare nec sollicitudin eget, venenatis et ante. Nam euismod nunc eu erat bibendum, nec venenatis sem sagittis.</p>
                        <p class="text-justify">Mauris ac malesuada orci. Nulla ac risus a dolor finibus molestie sed eget nibh. Maecenas porta nibh cursus, vehicula metus a, feugiat nulla. Suspendisse id accumsan nunc, et dictum ex. Nullam eget posuere tellus. Nunc massa nunc, pharetra sit amet purus sit amet, commodo dictum arcu. Nullam eleifend ipsum nec mattis molestie. Cras aliquam vehicula dui vel porttitor. Nunc et ligula pulvinar purus porta elementum. Morbi luctus dolor tortor, eget dictum elit molestie sed. Aenean sit amet feugiat neque, quis tempor lacus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras tempor purus lorem, ut ultricies tortor elementum eu. Proin a augue felis.</p>
                        <br/>
                        <p class="text-right">
                            <a href="#" onclick="print();" class="btn btn-warning btn-icon btn-icon-standalone">
                                <i class="fa fa-print"></i>
                                <span>Imprimir</span>
                            </a>
                        </p> 
                    </div>
                    <div class="tab-pane" id="tab-6">
                        <p class="text-center"><strong>Ayuda para quien maneja a los Proveedores</strong>  </p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc et convallis nisl. Etiam ultrices, risus quis commodo commodo, est erat malesuada ligula, quis scelerisque nulla nibh vel ipsum. Pellentesque at euismod risus. Phasellus lacus nisi, hendrerit non ex congue, maximus ullamcorper tortor. Donec sodales diam sed velit tristique feugiat. Sed viverra nec massa sit amet maximus. Nam nec tortor quis dui faucibus imperdiet ut quis magna. Phasellus aliquam lorem in consequat rhoncus. Proin vel ornare lacus. Etiam et luctus sapien. Sed a arcu porttitor, sagittis diam sit amet, tristique neque. Nam rutrum ante vel sodales posuere. Maecenas dolor mi, consequat sed leo eget, congue convallis sem. Etiam est mi, ornare nec sollicitudin eget, venenatis et ante. Nam euismod nunc eu erat bibendum, nec venenatis sem sagittis.</p>
                        <p class="text-justify">Mauris ac malesuada orci. Nulla ac risus a dolor finibus molestie sed eget nibh. Maecenas porta nibh cursus, vehicula metus a, feugiat nulla. Suspendisse id accumsan nunc, et dictum ex. Nullam eget posuere tellus. Nunc massa nunc, pharetra sit amet purus sit amet, commodo dictum arcu. Nullam eleifend ipsum nec mattis molestie. Cras aliquam vehicula dui vel porttitor. Nunc et ligula pulvinar purus porta elementum. Morbi luctus dolor tortor, eget dictum elit molestie sed. Aenean sit amet feugiat neque, quis tempor lacus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras tempor purus lorem, ut ultricies tortor elementum eu. Proin a augue felis.</p>
                        <br/>
                        <p class="text-right">
                            <a href="#" onclick="print();" class="btn btn-warning btn-icon btn-icon-standalone">
                                <i class="fa fa-print"></i>
                                <span>Imprimir</span>
                            </a>
                        </p>                         
                    </div>                     
                    <div class="tab-pane" id="tab-7">
                        <p class="text-center"><strong>Ayuda para quien maneja la Bancarizacion </strong>  </p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc et convallis nisl. Etiam ultrices, risus quis commodo commodo, est erat malesuada ligula, quis scelerisque nulla nibh vel ipsum. Pellentesque at euismod risus. Phasellus lacus nisi, hendrerit non ex congue, maximus ullamcorper tortor. Donec sodales diam sed velit tristique feugiat. Sed viverra nec massa sit amet maximus. Nam nec tortor quis dui faucibus imperdiet ut quis magna. Phasellus aliquam lorem in consequat rhoncus. Proin vel ornare lacus. Etiam et luctus sapien. Sed a arcu porttitor, sagittis diam sit amet, tristique neque. Nam rutrum ante vel sodales posuere. Maecenas dolor mi, consequat sed leo eget, congue convallis sem. Etiam est mi, ornare nec sollicitudin eget, venenatis et ante. Nam euismod nunc eu erat bibendum, nec venenatis sem sagittis.</p>
                        <p class="text-justify">Mauris ac malesuada orci. Nulla ac risus a dolor finibus molestie sed eget nibh. Maecenas porta nibh cursus, vehicula metus a, feugiat nulla. Suspendisse id accumsan nunc, et dictum ex. Nullam eget posuere tellus. Nunc massa nunc, pharetra sit amet purus sit amet, commodo dictum arcu. Nullam eleifend ipsum nec mattis molestie. Cras aliquam vehicula dui vel porttitor. Nunc et ligula pulvinar purus porta elementum. Morbi luctus dolor tortor, eget dictum elit molestie sed. Aenean sit amet feugiat neque, quis tempor lacus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras tempor purus lorem, ut ultricies tortor elementum eu. Proin a augue felis.</p>
                        <br/>
                        <p class="text-right">
                            <a href="#" onclick="print();" class="btn btn-warning btn-icon btn-icon-standalone">
                                <i class="fa fa-print"></i>
                                <span>Imprimir</span>
                            </a>
                        </p>                         
                    </div>
                    <div class="tab-pane" id="tab-8">
                        <p class="text-center"><strong>Ayuda para quien maneja los Reportes</strong>  </p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc et convallis nisl. Etiam ultrices, risus quis commodo commodo, est erat malesuada ligula, quis scelerisque nulla nibh vel ipsum. Pellentesque at euismod risus. Phasellus lacus nisi, hendrerit non ex congue, maximus ullamcorper tortor. Donec sodales diam sed velit tristique feugiat. Sed viverra nec massa sit amet maximus. Nam nec tortor quis dui faucibus imperdiet ut quis magna. Phasellus aliquam lorem in consequat rhoncus. Proin vel ornare lacus. Etiam et luctus sapien. Sed a arcu porttitor, sagittis diam sit amet, tristique neque. Nam rutrum ante vel sodales posuere. Maecenas dolor mi, consequat sed leo eget, congue convallis sem. Etiam est mi, ornare nec sollicitudin eget, venenatis et ante. Nam euismod nunc eu erat bibendum, nec venenatis sem sagittis.</p>
                        <p class="text-justify">Mauris ac malesuada orci. Nulla ac risus a dolor finibus molestie sed eget nibh. Maecenas porta nibh cursus, vehicula metus a, feugiat nulla. Suspendisse id accumsan nunc, et dictum ex. Nullam eget posuere tellus. Nunc massa nunc, pharetra sit amet purus sit amet, commodo dictum arcu. Nullam eleifend ipsum nec mattis molestie. Cras aliquam vehicula dui vel porttitor. Nunc et ligula pulvinar purus porta elementum. Morbi luctus dolor tortor, eget dictum elit molestie sed. Aenean sit amet feugiat neque, quis tempor lacus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras tempor purus lorem, ut ultricies tortor elementum eu. Proin a augue felis.</p>
                        <br/>
                        <p class="text-right">
                            <a href="#" onclick="print();" class="btn btn-warning btn-icon btn-icon-standalone">
                                <i class="fa fa-print"></i>
                                <span>Imprimir</span>
                            </a>
                        </p>                         
                    </div>   
                    <div class="tab-pane" id="tab-9">
                        <p class="text-center"><strong>Ayuda para quien maneja la Seguridad del sistema</strong>  </p>
                        <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc et convallis nisl. Etiam ultrices, risus quis commodo commodo, est erat malesuada ligula, quis scelerisque nulla nibh vel ipsum. Pellentesque at euismod risus. Phasellus lacus nisi, hendrerit non ex congue, maximus ullamcorper tortor. Donec sodales diam sed velit tristique feugiat. Sed viverra nec massa sit amet maximus. Nam nec tortor quis dui faucibus imperdiet ut quis magna. Phasellus aliquam lorem in consequat rhoncus. Proin vel ornare lacus. Etiam et luctus sapien. Sed a arcu porttitor, sagittis diam sit amet, tristique neque. Nam rutrum ante vel sodales posuere. Maecenas dolor mi, consequat sed leo eget, congue convallis sem. Etiam est mi, ornare nec sollicitudin eget, venenatis et ante. Nam euismod nunc eu erat bibendum, nec venenatis sem sagittis.</p>
                        <p class="text-justify">Mauris ac malesuada orci. Nulla ac risus a dolor finibus molestie sed eget nibh. Maecenas porta nibh cursus, vehicula metus a, feugiat nulla. Suspendisse id accumsan nunc, et dictum ex. Nullam eget posuere tellus. Nunc massa nunc, pharetra sit amet purus sit amet, commodo dictum arcu. Nullam eleifend ipsum nec mattis molestie. Cras aliquam vehicula dui vel porttitor. Nunc et ligula pulvinar purus porta elementum. Morbi luctus dolor tortor, eget dictum elit molestie sed. Aenean sit amet feugiat neque, quis tempor lacus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras tempor purus lorem, ut ultricies tortor elementum eu. Proin a augue felis.</p>
                        <br/>
                        <p class="text-right">
                            <a href="#" onclick="print();" class="btn btn-warning btn-icon btn-icon-standalone">
                                <i class="fa fa-print"></i>
                                <span>Imprimir</span>
                            </a>
                        </p>                         
                    </div>                       
                </div>

            </div>
        </div>                

    </div>

</div>
