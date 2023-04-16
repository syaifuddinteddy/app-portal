<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>

                </a>
            </li>

            @if(session('menu'))
                @foreach(session('menu') as $index => $value)

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-archive"></i>
                                <span>{{$value->nm_menu}}</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                            @foreach(session('subMenu') as $idx => $valSub)
                                @php
                                $menuDinamis = [28,63,42,43,40,41,27,44]
                                @endphp

                                @if($valSub->id_parent == $value->id_menu )
                                    <li>
                                       <a href="{{ !in_array($valSub->id_menu, $menuDinamis) ? URL::to($valSub->link) : URL::to('menuDinamis/'.$valSub->link)}}">
                                             <i class="fa fa-folder"></i>
                                         <span>{{$valSub->nm_menu}}</span>
                                       </a>
                                    </li>
                                @endif
                            @endforeach
                            </ul>
                        </li>


                @endforeach
            @endif
        </ul><!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
