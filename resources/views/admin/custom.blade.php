<script>
    $(function () {
        $('.textareaa').wysihtml5()

      })
      $(document).ready(function() {
        $('.select2').select2();
        $('#category').multiselect();

    });


    $(document).ready(function(){

        // Initialize select2
        $(".selUser").select2();

        // Read selected option

    });

    {{-- $('.plus_row').click(function(){
        $('.add_data').toggle();


   }); --}}
   function plus_row(e ,$id) {

    //$(e).parent().parent().parent().parent().remove("");
    $(e).parent().parent().parent().parent().parent().find(".add_data"+$id).toggle('display');
      //$('.add_data').val($id);
   }

  
   $(document).ready(function(){
    //Dropzone class
       var myDropzone = new Dropzone(".dropzone", {
           url: "",
           paramName: "file",
           addRemoveLinks: true,
           acceptedFiles: "image/*",
            autoProcessQueue: true,
             init: function () {
           var totalFiles = 0,
               completeFiles = 0;
           this.on("addedfile", function (file) {
               totalFiles += 1;


           });
           this.on("removed file", function (file) {
               totalFiles -= 1;
           });
           this.on("complete", function (file) {
               completeFiles += 1;
               if (completeFiles === totalFiles) {
                  showProductImages($selectedPid);
                  myDropzone.removeFile(file);
               }
           });
       }
       });


   });
 

 
 
</script>
