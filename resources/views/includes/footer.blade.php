<script>
  $(document).ready(function(){
    $('#openMenu').click(function(e){
      e.preventDefault();
      $('.sidebar').toggleClass('collapsed');
      $('.content-page').toggleClass('translated');
      $('.container-fluid').css('overflow-x', 'hidden');
    });
  });
</script>
