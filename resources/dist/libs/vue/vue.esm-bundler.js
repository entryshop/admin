/**
* vue v3.4.38
* (c) 2018-present Yuxi (Evan) You and Vue contributors
* @license MIT
**/
import * as runtimeDom from '@vue/runtime-dom';
import { initCustomFormatter, registerRuntimeCompiler, warn } from '@vue/runtime-dom';
export * from '@vue/runtime-dom';
import { compile } from '@vue/compiler-dom';
import { isString, NOOP, extend, generateCodeFrame, EMPTY_OBJ } from '@vue/shared';

function initDev() {
  {
    initCustomFormatter();
  }
}

if (!!(process.env.NODE_ENV !== "production")) {
  initDev();
}
const compileCache = /* @__PURE__ */ new WeakMap();
function getCache(options) {
  let c = compileCache.get(options != null ? options : EMPTY_OBJ);
  if (!c) {
    c = /* @__PURE__ */ Object.create(null);
    compileCache.set(options != null ? options : EMPTY_OBJ, c);
  }
  return c;
}
function compileToFunction(template, options) {
  if (!isString(template)) {
    if (template.nodeType) {
      template = template.innerHTML;
    } else {
      !!(process.env.NODE_ENV !== "production") && warn(`invalid template option: `, template);
      return NOOP;
    }
  }
  const key = template;
  const cache = getCache(options);
  const cached = cache[key];
  if (cached) {
    return cached;
  }
  if (template[0] === "#") {
    const el = document.querySelector(template);
    if (!!(process.env.NODE_ENV !== "production") && !el) {
      warn(`Template element not found or is empty: ${template}`);
    }
    template = el ? el.innerHTML : ``;
  }
  const opts = extend(
    {
      hoistStatic: true,
      onError: !!(process.env.NODE_ENV !== "production") ? onError : void 0,
      onWarn: !!(process.env.NODE_ENV !== "production") ? (e) => onError(e, true) : NOOP
    },
    options
  );
  if (!opts.isCustomElement && typeof customElements !== "undefined") {
    opts.isCustomElement = (tag) => !!customElements.get(tag);
  }
  const { code } = compile(template, opts);
  function onError(err, asWarning = false) {
    const message = asWarning ? err.message : `Template compilation error: ${err.message}`;
    const codeFrame = err.loc && generateCodeFrame(
      template,
      err.loc.start.offset,
      err.loc.end.offset
    );
    warn(codeFrame ? `${message}
${codeFrame}` : message);
  }
  const render = new Function("Vue", code)(runtimeDom);
  render._rc = true;
  return cache[key] = render;
}
registerRuntimeCompiler(compileToFunction);

export { compileToFunction as compile };
