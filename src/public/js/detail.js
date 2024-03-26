// date
const dateElement = document.querySelector('#date');
dateElement.addEventListener('change', (event) => {
    const result = document.querySelector('.output-date');
    result.textContent = event.target.value;
});

// time
const timeElement = document.querySelector('#time');
timeElement.addEventListener('change', (event) => {
    const result = document.querySelector('.output-time');
    result.textContent = event.target.value;
});

// people
const peopleElement = document.querySelector('#people');
peopleElement.addEventListener('change', (event) => {
    const result = document.querySelector('.output-people');
    result.textContent = event.target.value;
});
