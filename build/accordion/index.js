(()=>{"use strict";var e,o={545:()=>{const e=window.wp.blocks,o=JSON.parse('{"u2":"pixelalbatross/accordion"}'),r=window.wp.element,t=window.wp.components,n=window.wp.blockEditor;(0,e.registerBlockType)(o.u2,{icon:()=>(0,r.createElement)(t.SVG,{xmlns:"http://www.w3.org/2000/svg",width:"17",height:"17",viewBox:"0 0 17 17"},(0,r.createElement)(t.Path,{d:"M0 0v4h17V0H0zm16 3H1V1h15v2zM0 10h17V6H0v4zm1-3h15v2H1V7zm-1 9h17v-4H0v4zm1-3h15v2H1v-2z"})),edit:function(){const e=(0,n.useBlockProps)(),o=(0,n.useInnerBlocksProps)(e,{allowedBlocks:["pixelalbatross/accordion-item"],template:[["pixelalbatross/accordion-item"],["pixelalbatross/accordion-item"]]});return(0,r.createElement)("div",e,(0,r.createElement)("div",o))},save:function(){return(0,r.createElement)(n.InnerBlocks.Content,null)}})}},r={};function t(e){var n=r[e];if(void 0!==n)return n.exports;var i=r[e]={exports:{}};return o[e](i,i.exports,t),i.exports}t.m=o,e=[],t.O=(o,r,n,i)=>{if(!r){var l=1/0;for(v=0;v<e.length;v++){for(var[r,n,i]=e[v],a=!0,c=0;c<r.length;c++)(!1&i||l>=i)&&Object.keys(t.O).every((e=>t.O[e](r[c])))?r.splice(c--,1):(a=!1,i<l&&(l=i));if(a){e.splice(v--,1);var s=n();void 0!==s&&(o=s)}}return o}i=i||0;for(var v=e.length;v>0&&e[v-1][2]>i;v--)e[v]=e[v-1];e[v]=[r,n,i]},t.o=(e,o)=>Object.prototype.hasOwnProperty.call(e,o),(()=>{var e={166:0,82:0};t.O.j=o=>0===e[o];var o=(o,r)=>{var n,i,[l,a,c]=r,s=0;if(l.some((o=>0!==e[o]))){for(n in a)t.o(a,n)&&(t.m[n]=a[n]);if(c)var v=c(t)}for(o&&o(r);s<l.length;s++)i=l[s],t.o(e,i)&&e[i]&&e[i][0](),e[i]=0;return t.O(v)},r=globalThis.webpackChunkaccordion_block=globalThis.webpackChunkaccordion_block||[];r.forEach(o.bind(null,0)),r.push=o.bind(null,r.push.bind(r))})();var n=t.O(void 0,[82],(()=>t(545)));n=t.O(n)})();