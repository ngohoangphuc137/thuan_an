<script>
    $(document).ready(function(){
        console.log(window.location);
        $('.selectFilter').on('change',function(){
          var  currentURL = window.location;
          
          const value = $(this).val();
          const newQueryParam = {
            ordelBy:value
          }
          if(currentURL.search){
            const urlParams = new URLSearchParams(currentURL.search)
            let seturl = currentURL.href+`&${$.param(newQueryParam)}`
            const param1 = urlParams.get('ordelBy')
            console.log(param1);
            
            
          }else{
            window.location.replace(`?kytu=${value}`)
          }
        })
    })
</script>