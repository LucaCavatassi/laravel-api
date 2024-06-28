import "./bootstrap";
import "~resources/scss/app.scss";
import.meta.glob(["../img/**"]);
import * as bootstrap from "bootstrap";


// FILTER BY TYPE
const items = document.getElementsByClassName("ms-item");
// FRONT-END FILTER
const front_end_btn = document.getElementById("front_end");
front_end_btn.addEventListener("click", show_front_end);

function show_front_end() {    
    for (let i = 0; i < items.length; i++) {
        const curElem = items[i];
        curElem.classList.remove("d-none");
        if (!curElem.classList.contains("list-group-item-warning")) {
            curElem.classList.add("d-none");   
        }
    }
};

// BACK-END FILTER
const back_end_btn = document.getElementById("back_end");
back_end_btn.addEventListener("click", show_back_end);

function show_back_end() {    
    for (let i = 0; i < items.length; i++) {
        const curElem = items[i];
        curElem.classList.remove("d-none");

        if (!curElem.classList.contains("list-group-item-info")) {
            curElem.classList.add("d-none");
        }
    }
};

// FULL-STACK FILTER
const full_stack_btn = document.getElementById("full_stack");
full_stack_btn.addEventListener("click", show_full_stack);

function show_full_stack() {    
    for (let i = 0; i < items.length; i++) {
        const curElem = items[i];
        curElem.classList.remove("d-none");

        if (!curElem.classList.contains("list-group-item-success")) {
            curElem.classList.add("d-none");
        }
    }
};

// NULL
const null_btn = document.getElementById("null");
null_btn.addEventListener("click", show_null);

function show_null() {    
    for (let i = 0; i < items.length; i++) {
        const curElem = items[i];
        curElem.classList.remove("d-none");

        if (!curElem.classList.contains("list-group-item-secondary")) {
            curElem.classList.add("d-none");
        }
    }
};

// ALL
const all_btn = document.getElementById("all");
all_btn.addEventListener("click", show_all);

function show_all() {    
    for (let i = 0; i < items.length; i++) {
        const curElem = items[i];
        curElem.classList.remove("d-none");
    }
};