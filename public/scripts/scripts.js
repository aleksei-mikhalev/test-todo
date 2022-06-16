document.addEventListener('DOMContentLoaded', function() {
    setCurrentSort();
    textareaAutoSize();
});

function onClickPage(el) {
    document.getElementById('page').value = el.textContent;
    var e = new Event('change');
    document.getElementById('page').dispatchEvent(e);
}

function onChangeTask(el) {
    var id = el.id.split('_')[1];
    var text = document.getElementById('text_' + id).value;
    var done = document.getElementById('done_' + id).checked;

    fetch('./change-status', {
        method: 'POST',
        body: JSON.stringify({
            'task': id,
            'text': text,
            'done': done
        }),
    }).then(function(response) {
        if (response.ok) {
            return response.text();
        }
        return Promise.reject(response);
    }).then(function(data) {
        if (data != '') {
            alert(data);
        }
    });
}

function setCurrentSort() {
    var sortEl = document.getElementById('sort');

    if (sortEl) {
        var url = new URL(window.location.href);
        var sort = url.searchParams.get('sort');

        sortEl.value = sort;
    }
}

function textareaAutoSize() {
    document.querySelectorAll('[data-autoresize]').forEach(function (element) {
        element.style.height = (element.scrollHeight)+'px';

        element.style.boxSizing = 'border-box';
        var offset = element.offsetHeight - element.clientHeight;
        element.addEventListener('input', function (event) {
            event.target.style.height = 'auto';
            event.target.style.height = event.target.scrollHeight + offset + 'px';
        });
        element.removeAttribute('data-autoresize');
    });
  }
