export default code => {
  const ready = (callback) => {
    if (document.readyState !== "loading") callback();
    else document.addEventListener("DOMContentLoaded", callback);
  }

  ready(() => {
    code()
  })
}
