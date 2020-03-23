const filters = {
  truncate(value, limit) {
    if (value.length > limit) {
      value = value.substring(0, limit - 3) + "...";
    }

    return value;
  },
  striphtml(value) {
    var div = document.createElement("div");
    div.innerHTML = value;
    var text = div.textContent || div.innerText || "";
    return text;
  }
};

export default filters;
