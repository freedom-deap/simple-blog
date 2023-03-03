// 編集画面での画像追加/更新/削除処理
const imgForm = document.getElementById('img-form');
const imgFile = document.getElementById('img-file');
if(imgForm !== null && imgFile.files[0] !== null){
    const formData = new FormData(imgForm);
    imgForm.addEventListener('submit', (event) => {
        formData.append('command', event.submitter.value);
        formData.append('img_file', imgFile.files[0]);
        console.log(formData);
        event.stopPropagation();
        event.preventDefault();
        const options = {
          method: 'POST',
          body: formData,
        }
        const url = imgForm.getAttribute('action');
        fetch(url, options)
            .then(response => response.json())
            .then(res => {
                console.log(res);
            })
            .catch(error => {
                alert('failure');
            });
        imgForm.reset();
    });
}