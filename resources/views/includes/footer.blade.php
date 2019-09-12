Footer
<script>
  $(document).ready(function(){
    $('#openMenu').click(function(e){
      e.preventDefault();
      $('.sidebar').toggleClass('collapsed');
      $('.content-page').toggleClass('translated');
      $('body').css('overflow-x', 'hidden');
    });
  });
</script>
