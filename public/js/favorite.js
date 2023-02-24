// 下記サイト参考
// https://qiita.com/Laravel-student/items/bbf7a370d7c6b02624ff
const forms = document.querySelectorAll('.favorite-form');
for(form of forms){
    let formData = new FormData(form);
    form.addEventListener('submit', (event) => {
        event.stopPropagation();
        event.preventDefault();
        // const formData = new FormData(form);
        let options = {
          method: 'POST',
          body: formData,
        }
        let url = form.getAttribute('action');
        fetch(url, options)
            .then(response => response.json())
            .then(res => {
                let entryId = formData.get('entry_id');
                const star = document.querySelector('svg.entry-' + entryId);
                console.log(star);
                if(res.isFavorited){
                    star.classList.add('favorited');
                    star.classList.remove('unfavorited');
                }else{
                    star.classList.add('unfavorited');
                    star.classList.remove('favorited');
                }
            })
            .catch(error => {
                alert('failure');
        });
    });
};
