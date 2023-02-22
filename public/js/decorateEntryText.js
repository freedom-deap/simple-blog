const entryContent = document.getElementById('entry-text').children;

for (const element of entryContent) {
    switch (element.tagName) {
        case 'H1':
            element.classList.add('text-xl');
            element.classList.add('mt-5');
            break;
        case 'H2':
            element.classList.add('text-lg');
            element.classList.add('mt-5');
            break;
        case 'H3':
            element.classList.add('text-base');
            element.classList.add('mt-5');
            break;
        case 'P':
            element.classList.add('mt-4');
            break;
        default:
            break;
    }
}

