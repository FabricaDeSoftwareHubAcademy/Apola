const imgInp = document.getElementById('imgInput')
const blah = document.getElementById('preview_img')

imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
      blah.src = URL.createObjectURL(file)
    }
  }