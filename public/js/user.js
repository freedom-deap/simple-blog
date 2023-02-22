const userName = document.getElementById('user-name');
userName.innerHTML = userName.innerHTML.replaceAll('\n', '<br>');

function changeActiveTab(event, selected){
    const activeTab = document.getElementsByClassName('tab-active')[0];
    const selectTab = event.target;
    if(event.target.isEqualNode(activeTab)){ return; }

    event.target.classList.add('tab-active');
    activeTab.classList.remove('tab-active');
    
    const activeContent = document.getElementsByClassName('active')[0];
    const selectedContent = document.getElementById(selected);
    activeContent.classList.remove('active');
    activeContent.classList.add('hidden');
    selectedContent.classList.add('active');
    selectedContent.classList.remove('hidden');
}