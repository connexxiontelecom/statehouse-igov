<?=view('pages/posts/_post-scripts.php')?>
<script>
	$(document).ready(function () {
        Dropzone.autoDiscover = false;
        let name = new Date().getTime();
        let myDropzone = this;
        $("div#myId").dropzone({
            renameFile: function(file) {
                // console.log(name + '_' + file.name);
               // return new Date().getTime() + '_' + file.upload.filename;
                return name + '_' + file.name.replace(/\s/g, '');
                //return name + '_' + file.name;
                //return newName;
            },
            url: '<?=site_url('upload-post-attachments'); ?>',
            method: 'post',
            addRemoveLinks: 'true',
            dictRemoveFile: 'Remove',

            success: function(file, response) {
               
               $('form').append('<input type="hidden" name="p_attachment[]" value="' + response + '">');
               
               console.log(response);
            },

            error: function(file, response) {
                console.log(response);
            },
            removedfile: function(file) {
                file.previewElement.remove();
                $('form').find('input[name="p_attachment[]"][value="' + name + '_' + file.name + '"]').remove()
				let p_name = name + "_" + file.name;
                $.ajax({
                    url: '<?=site_url('delete-post-attachments')?>',
                    type: 'GET',
                    data:  'files='+p_name,
                    dataType: 'json',
                    success: response => {
                     // console.log(response.message);
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
                //                    var name = '';
                //                    if (typeof file.file_name !== 'undefined') {
                //                        name = file.file_name
                //                    } else {
                //                        name = uploadedDocumentMap[file.name]
                //                    }
                // $('form').find('input[name="p_attachment[]"][value="' + name + '_' + file.name + '"]').remove()
                
            }
        });
	    
		$('#new-internal-circular-form').submit(function (e) {
			e.preventDefault()
			let body = quillEditor.root.innerHTML
			let formData = new FormData(this)
      formData.set('p_body', body)
      Swal.fire({
        title: 'Are you sure?',
        text: 'This will submit your circular to the iGov system',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirm',
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33"
      }).then(confirm => {
        // if (confirm.value) {
         $.ajax({
            url: '<?=site_url('/internal-circular')?>',
            type: 'post',
            data: formData,
            success: response => {
              if (response.success) {
                Swal.fire('Confirmed!', response.message, 'success').then(() => location.href = '<?=site_url('/my-circulars')?>')
              } else {
                Swal.fire('Sorry!', response.message, 'error')
              }
            },
            cache: false,
            contentType: false,
            processData: false
          })
        // }
      })
    })

    $('form#edit-circular-form').submit(function (e) {
      e.preventDefault()
      let body = quillEditor.root.innerHTML
      let formData = new FormData(this)
      formData.set('p_body', body)
      Swal.fire({
        title: 'Are you sure?',
        text: 'This will submit new changes to your circular to the iGov system',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirm',
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33"
      }).then(confirm => {
        if (confirm.value) {
          $.ajax({
            url: '<?=site_url('/edit-circular')?>',
            type: 'post',
            data: formData,
            success: response => {
              if (response.success) {
                Swal.fire('Confirmed!', response.message, 'success').then(() => location.href = '<?=site_url('/my-circulars')?>')
              } else {
                Swal.fire('Sorry!', response.message, 'error')
              }
            },
            cache: false,
            contentType: false,
            processData: false
          })
        }
      })
    })
  })


  
</script>

