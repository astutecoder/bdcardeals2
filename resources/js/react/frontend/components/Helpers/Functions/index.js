export const activateWait = () => {
    let body = document.querySelector('body');
    let div = document.createElement('div');
    div
        .classList
        .add('pleaseWait');
    body.appendChild(div);
    body.style.overflow = 'hidden';
}

export const deactivateWait = () => {
    let body = document.querySelector('body');
    let pleaseWait = document.querySelector('.pleaseWait');
    pleaseWait
        .parentNode
        .removeChild(pleaseWait);
    body.removeAttribute('style')
}