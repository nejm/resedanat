<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Tous les articles</h1>
            <!--<form action=<?=base_url("admin/modifier/")?> method="post">-->

                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Titre</th>
                        <th>Publier</th>
                        <th>Action</th>
                    </tr>

                    </thead>
                    <?php

                    "</td      foreach ($articles as $article)
                        {
                            echo "<tr><td>".$article->id.
                                 "</td><td>".$article->titre.><td>";
                                if($article->etat == 1) echo "Oui"; else echo "Non";
                                echo "</td><td><a href='".base_url("admin/modifier/{$article->id}")."'
                                class='btn btn-info'>Modifier</a>
                                      <button class='btn btn-danger' data-toggle='modal' data-target='#deleteModal'
                                      onclick=deleteArticle(".$article->id.")>Supprimer</button></td></tr>";
                        }
                    ?>
                </table>
            <!--</form>-->
        </div>
    </div>
</div>

<!-------------------------------------------------------------------->
<div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Etes-Vous sûr de vouloir supprimer l'article</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
                <button type="button" id="validate" class="btn btn-danger">Oui</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-------------------------------------------------------------------->
<script src=<?=js_url("jquery")?>></script>
<script src=<?=js_url("bootstrap.min")?>></script>
<script src=<?=js_url("alertify.min")?>></script>
<script type="text/javascript">
<?php if(isset($msg)):?>
    alertify.success("<?php echo $article->titre;?> modifié avec succées");
<?php endif ?>
    function deleteArticle(id)
    {
        $("#validate").click(function(){
            $.ajax({
                url  : "http://localhost/residanat/admin/deleteArticle",
                type : "post",
                data : "id="+id
            }).done(function(){
                location.reload();
            });
        });
    }
</script>

</body>
</body>
</html>