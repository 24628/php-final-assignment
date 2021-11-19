<script type="text/javascript">

    window.onload = (event) => {
        fetch("/get-posts")
            .then(response => response.json())
            .then((data) => {
                console.log(data);
                document.dispatchEvent(new CustomEvent('data-is-loaded', {
                    detail: data,
                }))
            })
    };


    class PostComponent extends HTMLElement {
        _style = document.createElement('style');
        _template = document.createElement('template');

        constructor() {
            super();
            this._style.innerHTML = `
                 .btn-danger {
                    color: #fff;
                    background-color: #dc3545;
                    border-color: #dc3545;
                }

                .btn-primary {
                    color: #fff;
                    background-color: #007bff;
                    border-color: #007bff;
                }

                .btn {
                    text-decoration:none;
                    display: inline-block;
                    font-weight: 400;
                    text-align: center;
                    white-space: nowrap;
                    vertical-align: middle;
                    -webkit-user-select: none;
                    -moz-user-select: none;
                    -ms-user-select: none;
                    user-select: none;
                    border: 1px solid transparent;
                    padding: .375rem .75rem;
                    font-size: 1rem;
                    line-height: 1.5;
                    border-radius: .25rem;
                    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
                }

                .table {
                  font-family: Arial, Helvetica, sans-serif;
                  border-collapse: collapse;
                  width: 100%;
                }

                .table td, .table th {
                  border: 1px solid #ddd;
                  padding: 8px;
                }

                .table tr:nth-child(even){background-color: #f2f2f2;}

                .table tr:hover {background-color: #ddd;}

                .table th {
                  padding-top: 12px;
                  padding-bottom: 12px;
                  text-align: left;
                  background-color: #04AA6D;
                  color: white;
                }
            `;

            document.addEventListener("data-is-loaded", (evt => {
                this.updateComponent(evt.detail)
            }));
            this._template.innerHTML = `<table class="table"></table>`;
            this.attachShadow({mode: 'open'});
            this.shadowRoot.appendChild(this._style);
            this.shadowRoot.appendChild(this._template.content.cloneNode(true));
        }

        updateComponent(data) {
            const div = this.shadowRoot.querySelector(".table");
            div.innerHTML = '';
            div.innerHTML += `<tr>
                    <th scope="col">id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>`;

            data.forEach((item) => {
                div.innerHTML +=`
                <td>${item.id}</td>
                <td>${item.title}</td>
                <td>
                    <form action="/post-update" method="post">
                        <input type="hidden" value="${item.id}}" name="update-id">
                        <button class="btn btn-primary" role="button">update</button>
                    </form>
                </td>
                <td>
                    <form action="/post-delete" method="post">
                        <input type="hidden" value="${item.id}}" name="delete-id">
                        <button class="btn btn-danger" role="button">delete</button>
                    </form>
                </td>
            </tr>`;
            })
        }
    }

    customElements.define('post-component', PostComponent);
</script>

<div style="height: 100%;
    display: flex;
    flex-direction: column;
    padding: 30px 20px;
    align-items: end">
<post-component style="width: 100%;"></post-component>

<a class="btn btn-primary" style="width: 120px; margin-top: auto" href="/post-create" role="button">create</a>
</div>
