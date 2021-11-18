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
                <td><a class="btn btn-primary" href="${window.origin + "/post-show/" + item.id}" role="button">update</a></td>
                <td><a class="btn btn-danger" href="${window.origin + "/post-delete/" + item.id}"  role="button">delete</a></td>
            </tr>`;
            })
        }
    }

    customElements.define('post-component', PostComponent);
</script>

<post-component style="padding: 20px 30px;"></post-component>
