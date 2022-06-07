<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
</div>

<script>
    var modal = document.getElementById("myModal");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    function imgClick(source){
        modal.style.display = "block";
        modalImg.src = source;
    }
    var span = document.getElementsByClassName("close")[0];
    span.onclick = function() { 
        modal.style.display = "none";
    }
</script>

<!-- Pentru a instala acest obiect se adauga " onclick='imgClick(this.src)" la imagine -->
<!-- Se recomada utilizarea acestui obiect la finalul paginii (chiar inaintea </body>) -->