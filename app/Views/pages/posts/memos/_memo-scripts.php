<?=view('pages/posts/_post-scripts.php')?>
<script>
	$(document).ready(function () {
		$('form#new-internal-memo-form').submit(function (e) {
			e.preventDefault()
      let subject = $('#subject').val()
      let signedBy = $('#signed-by').val()
      let refNo = $('#ref-no').val()
      let positions = $('#positions').val()
      if (!subject || !signedBy || !refNo || !positions || quillEditor.root.innerText.length < 2) {
        Swal.fire('Invalid Submission!', 'Please fill in all required fields', 'error')
      } else {
        let body = quillEditor.root.innerHTML
        let formData = new FormData(this)
        formData.set('p_body', body)
        Swal.fire({
          title: 'Are you sure?',
          text: 'This will submit your memo to the iGov system',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Confirm',
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33"
        }).then(confirm => {
          if (confirm.value) {
            $.ajax({
              url: '<?=site_url('/internal-memo')?>',
              type: 'post',
              data: formData,
              success: response => {
                if (response.success) {
                  Swal.fire('Confirmed!', response.message, 'success').then(() => location.href = '<?=site_url('/my-memos')?>')
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
      }
    })

    $('form#new-external-memo-form').submit(function (e) {
      e.preventDefault()
      let subject = $('#subject').val()
      let signedBy = $('#signed-by').val()
      let refNo = $('#ref-no').val()
      let positions = $('#positions').val()
      if (!subject || !signedBy || !refNo || !positions || quillEditor.root.innerText.length < 2) {
        Swal.fire('Invalid Submission!', 'Please fill in all required fields', 'error')
      } else {
        let body = quillEditor.root.innerHTML
        let formData = new FormData(this)
        formData.set('p_body', body)
        Swal.fire({
          title: 'Are you sure?',
          text: 'This will submit your memo to the iGov system',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Confirm',
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33"
        }).then(confirm => {
          if (confirm.value) {
            $.ajax({
              url: '<?=site_url('/external-memo')?>',
              type: 'post',
              data: formData,
              success: response => {
                if (response.success) {
                  Swal.fire('Confirmed!', response.message, 'success').then(() => location.href = '<?=site_url('/my-memos')?>')
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
      }
    })

    $('form#edit-internal-memo-form').submit(function (e) {
      e.preventDefault()
      let subject = $('#subject').val()
      let signedBy = $('#signed-by').val()
      let refNo = $('#ref-no').val()
      let positions = $('#positions').val()
      if (!subject || !signedBy || !refNo || !positions || quillEditor.root.innerText.length < 2) {
        Swal.fire('Invalid Submission!', 'Please fill in all required fields', 'error')
      } else {
        let body = quillEditor.root.innerHTML
        let formData = new FormData(this)
        formData.set('p_body', body)
        Swal.fire({
          title: 'Are you sure?',
          text: 'This will submit new changes to your memo to the iGov system',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Confirm',
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33"
        }).then(confirm => {
          if (confirm.value) {
            $.ajax({
              url: '<?=site_url('/edit-memo')?>',
              type: 'post',
              data: formData,
              success: response => {
                if (response.success) {
                  Swal.fire('Confirmed!', response.message, 'success').then(() => location.href = '<?=site_url('/my-memos')?>')
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
      }
    })
  })
</script>
