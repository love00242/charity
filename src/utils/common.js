export function debounce(fn, delay = 500) {
    console.log("debounce")
    let timer = null;
    return function (...args) {
        timer && clearTimeout(timer);
        timer = setTimeout(() => {
            fn.apply(this, args);
            timer = null;
        }, delay);
    }
}

export function sleep(delay = 500) {
    return new Promise((resolve) => setTimeout(resolve, delay));
}
