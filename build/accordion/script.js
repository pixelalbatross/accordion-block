document.addEventListener("DOMContentLoaded",(()=>{const t=document.querySelectorAll(".wp-block-pixelalbatross-accordion");if(!t.length)return;const e=function(t,e){const a=new CustomEvent(e,arguments.length>2&&void 0!==arguments[2]?arguments[2]:{});t.dispatchEvent(a)};t.forEach(((t,a)=>{t.querySelectorAll(".wp-block-pixelalbatross-accordion-item .accordion-heading").forEach(((t,i)=>{((t,a,i)=>{const d=t.querySelector("button[aria-expanded]");d.addEventListener("click",(()=>{(t=>{const a=t.getAttribute("aria-controls"),i=document.getElementById(a);i&&("true"===t.getAttribute("aria-expanded")?((t,a)=>{t.setAttribute("aria-expanded","false"),t.setAttribute("aria-label",t.dataset.ariaLabelOpen),a.setAttribute("hidden","until-found"),e(t,"accordion:item:close",{bubbles:!0,detail:{id:t.dataset.id}})})(t,i):((t,a)=>{t.setAttribute("aria-expanded","true"),t.setAttribute("aria-label",t.dataset.ariaLabelClose),a.removeAttribute("hidden"),e(t,"accordion:item:open",{bubbles:!0,detail:{id:t.dataset.id}})})(t,i))})(d)}));const o=`accordion-${a}-item-${i}`;d.setAttribute("id",`${o}-heading`),d.setAttribute("aria-controls",`${o}-panel`),d.setAttribute("data-id",o);const n=d.closest(".wp-block-pixelalbatross-accordion-item");if(n){n.setAttribute("id",o);const t=n.querySelector(".accordion-panel");t&&(t.setAttribute("id",`${o}-panel`),t.setAttribute("aria-labelledby",`${o}-heading`))}e(t,"accordion:init",{bubbles:!0,detail:{panelId:d.dataset.id}})})(t,a,i)}))}))}));