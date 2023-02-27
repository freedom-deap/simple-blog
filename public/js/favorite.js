// お気に入り登録数表示の更新
const changeFavoriteNum = (target, favoritedCount) => {
    let favoriteNumText = target.innerText.split(':');
    target.innerText = favoriteNumText[0] + ': ' + favoritedCount;
};

// 下記サイト参考
// https://qiita.com/Laravel-student/items/bbf7a370d7c6b02624ff

// 記事一覧でのお気に入り登録処理
const forms = document.querySelectorAll('.favorite-form');
for(form of forms){
    const formData = new FormData(form);
    form.addEventListener('submit', (event) => {
        event.stopPropagation();
        event.preventDefault();
        const options = {
          method: 'POST',
          body: formData,
        }
        let url = form.getAttribute('action');
        fetch(url, options)
            .then(response => response.json())
            .then(res => {
                const entryId = formData.get('entry_id');
                const star = document.querySelector('svg.entry-' + entryId);
                const numOfFavorite  = document.querySelector('#favorite-num' + entryId);
                
                changeFavoriteNum(numOfFavorite, res.favoritedCount);
                
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
}

// 閲覧画面でのお気に入り登録処理
const favoriteBtn = document.querySelector('form.favorite-btn');
if(favoriteBtn !== null){
    const formData = new FormData(favoriteBtn);
    favoriteBtn.addEventListener('submit', (event) => {
        event.stopPropagation();
        event.preventDefault();
        const options = {
          method: 'POST',
          body: formData,
        }
        const url = favoriteBtn.getAttribute('action');
        fetch(url, options)
            .then(response => response.json())
            .then(res => {
                const entryId = formData.get('entry_id');
                const btn = document.querySelector('button.favorite-btn');
                if(res.isFavorited){
                    btn.classList.add('btn-error');
                    btn.classList.remove('btn-info');
                    btn.innerText = 'お気に入り解除';
                }else{
                    btn.classList.add('btn-info');
                    btn.classList.remove('btn-error');
                    btn.innerText = 'お気に入り登録';
                }
            })
            .catch(error => {
                alert('failure');
        });
    });
}