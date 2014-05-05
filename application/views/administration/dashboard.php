<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-pills nav-stacked">
                <li><a href=<?=base_url("admin/ajout/");?>>Nouveau Article</a></li>
                <li><a href=<?=base_url("admin/modifier/");?>>Liste Article</a></li>
                <li><a href=<?=base_url("admin/media")?>>Gérer Media</a></li>
                <li><a href=<?=base_url("admin/etudiant/");?>>Liste Etudiant</a></li>
                <li><a href=<?=base_url("admin/user/")?>>Ajouter Utilisateur</a></li>
                <li><a href=<?=base_url("admin/chercher/")?>>Chercher Etudiant</a></li>
                <li><a href=<?=base_url("admin/choix/")?>>List des choix</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Dashboard</h1>
            <?php
                $data ="";
                $data2="";
                $i=0;
                foreach ($spec as $s)
                {
                    if($s->nbr_place > 0){
                        $i++;
                        $data.="[ '$s->libelle' , $s->nbr_place ],";
                    }
                    if($i===10) break;
                }

            //moyenne
                foreach ($moyenne as $k => $v)
                {
                    $data2.= "[ '$k' , $v ],";
                }


            //admission
                $s=$nombre-$admis;
                $data3= "[ 'Admis(e)' , $admis ],";
                $data3.= "[ 'Non Admis(e)' , $s ]";

                substr($data2,0,-1);
                substr($data,0,-1);
            ?>
            <div class="row-fluid sortable">
                <div class="box span12 tour">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-picture"></i>Blank</h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        Test
                    </div>
                </div><!--/span-->

            </div><!--/row-->

            <div id="moy" class="box"></div>
            <div class="col-sm-6 box" id="spec"></div>
            <div class="col-sm-6 box" id="choix"></div>
            <div class="col-sm-6 box" id="fac"></div>
        </div>
<!--        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <img data-src="holder.js/200x200/auto/vine" class="img-responsive" alt="200x200" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMDAiIGhlaWdodD0iMjAwIj48cmVjdCB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iIzM5REJBQyI+PC9yZWN0Pjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjEwMCIgeT0iMTAwIiBzdHlsZT0iZmlsbDojMUUyOTJDO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEzcHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+MjAweDIwMDwvdGV4dD48L3N2Zz4=">
            <h4>Label</h4>
            <span class="text-muted">Something else</span>
        </div>-->

</div>
</div>

<script src=<?=js_url("jquery")?>></script>
<script src=<?=js_url("bootstrap.min")?>></script>
<script src=<?=js_url("bootstrap-switch")?>></script>
<script src=<?=js_url("jquery-ui")?>></script>
<script src=<?=js_url("bootstrap-collapse")?>></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script type="text/javascript">
    $("#pb").bootstrapSwitch();
    // Load the Visualization API and the piechart package.
    google.load('visualization', '1.0', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);
    google.setOnLoadCallback(drawChart2);
    google.setOnLoadCallback(drawChart3);
    google.setOnLoadCallback(drawChart4);


    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
            <?=$data?>
        ]);

        // Set chart options
        var options = {'title':'Places libres des 10 premiers spécialités',
            'width':540,
            'height':500};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('spec'));
        chart.draw(data, options);
    }

    //---------------------------------------------------------\\
    function drawChart2() {
        var data2 = google.visualization.arrayToDataTable([
            ['Moyenne', 'Nombre d\'étudiants'],
            <?=$data2?>
        ]);

        var options2 = {
            title: 'Classement par moyenne',
            hAxis: {
                title: 'Moyenne',
                titleTextStyle: {color: 'black'}
                },
            is3D :true

        };

        var chart2 = new google.visualization.ColumnChart(document.getElementById('moy'));
        chart2.draw(data2, options2);
    }
    //---------------------------------------------------------------
    function drawChart3() {

        // Create the data table.
        var data3 = new google.visualization.DataTable();
        data3.addColumn('string', 'Topping');
        data3.addColumn('number', 'Slices');
        data3.addRows([
            <?=$data3?>
        ]);

        // Set chart options
        var options3 = {'title':'Pourcentage des personne selon leurs résultat',
            'width':540,
            'height':500};

        // Instantiate and draw our chart, passing in some options.
        var chart3 = new google.visualization.PieChart(document.getElementById('choix'));
        chart3.draw(data3, options3);
    }
//-----------------------------------------------------------------------------------------
    //---------------------------------------------------------------
    function drawChart4() {

        // Create the data table.
        var data4 = new google.visualization.DataTable();
        data4.addColumn('string', 'Topping');
        data4.addColumn('number', 'Slices');
        data4.addRows([
            ['Sousse',  <?=$sousse?>   ],
            ['Sfax',    <?=$sfax?>     ],
            ['Monastir',<?=$monastir?> ],
            ['Tunis',   <?=$tunis?>    ]
        ]);

        // Set chart options
        var options4 = {'title':'Pourcentage des personne selon la faculté',
            'width':540,
            'height':500};

        // Instantiate and draw our chart, passing in some options.
        var chart4 = new google.visualization.PieChart(document.getElementById('fac'));
        chart4.draw(data4, options4);
    }
</script>

</body>
</html>