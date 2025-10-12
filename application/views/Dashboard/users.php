        <!-- Header  -->
        <?php
        include('layout/header.php');
        ?>

        <!-- Start aside  -->
        <aside>
            <style>
                .search_add {
                    width: 100%;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    border-radius: 10px 10px 0 0;
                    background: #fff;
                    padding: 10px;
                }

                .search_add input {
                    outline: navajowhite;
                    padding: 8px 10px;
                    border-radius: 10px;
                    border: 1px solid #8080803d;
                }

                .search_add button {
                    background: #1b2c56;
                    color: #fff;
                    padding: 5px 10px;
                    border: navajowhite;
                    font-size: 12px;
                    box-shadow: 0 0 20px rgb(0, 0, 0, .2);
                    cursor: pointer;
                    border-radius: 10px;
                }

                /* Data Table  */
                .dataTable {
                    width: 100%;
                    height: calc(100vh - 135px);
                    background: #fff;
                    border-radius: 0 0 10px 10px;
                    overflow-y: auto;
                }

                .dataTable::-webkit-scrollbar {
                    display: none;
                }

                .dataTable table {
                    width: 100%;
                    border-collapse: collapse;
                }

                .dataTable table th,
                td,
                tr {
                    text-align: center;
                    padding: 3px 5px;
                    font-size: 13px;
                }

                .dataTable table thead {
                    background: #fff;
                    box-shadow: 0 10px 20px rgb(0, 0, 0, .2);
                    border-radius: 10px;
                    padding: 8px 0;
                    position: sticky;
                    top: 0;
                    margin: 10px 0;
                }

                .dataTable table thead tr th {
                    padding: 10px 0;
                }

                .dataTable table tbody tr td {
                    padding: 6px 0;
                }

                .dataTable table tbody tr td img {
                    width: 25px;
                    height: 25px;
                    border-radius: 5px;
                }

                .dataTable table tbody tr td button {
                    background: #1b2c56;
                    color: #fff;
                    padding: 5px 10px;
                    border: navajowhite;
                    font-size: 11px;
                    cursor: pointer;
                    border-radius: 8px;
                }


                /* Add Form  */
                .add_form {
                    width: 100%;
                    height: 100%;
                    display: none;
                    align-items: center;
                    justify-content: center;
                    position: absolute;
                    left: 0;
                    top: 0;
                    background: rgb(0, 0, 0, .1);
                    z-index: 999;
                }

                .add_form form {
                    position: relative;
                    width: 65%;
                    padding: 25px;
                    box-shadow: 0 0 20px rgb(0, 0, 0, .2);
                    border-radius: 10px;
                    background: #fff;
                    display: flex;
                    align-items: center;
                    flex-wrap: wrap;
                    gap: 1%;
                }

                .add_form form .card {
                    position: relative;
                    display: flex;
                    flex-direction: column;
                    width: 24%;
                    margin-bottom: 10px;
                }

                .add_form form .card label {
                    font-weight: 600;
                    font-size: 13px;
                }

                .add_form form .card input {
                    padding: 8px 10px;
                    border: 1px solid rgba(128, 128, 128, 0.26);
                    border-radius: 8px;
                    outline: none;
                    margin-top: 5px;
                }

                .add_form form .bi-x-circle-fill {
                    position: absolute;
                    top: -14px;
                    right: -7px;
                    cursor: pointer;
                    font-size: 20px;
                }

                .add_form form .card img {
                    width: 55px;
                    height: 35px;
                    position: absolute;
                    right: 2px;
                    top: 27px;
                    border-radius: 8px;
                    z-index: 999;
                    border: 3px solid #fff;
                    box-shadow: 0 0 20px rgb(0, 0, 0, .2);
                    display: none;
                }

                .add_form form .card_submit {
                    width: 100%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .add_form form .card_submit input {
                    width: 100px;
                    background: #000;
                    color: #fff;
                    border: 1px solid #000;
                    cursor: pointer;
                    transition: .3s linear;
                }

                .add_form form .card_submit input:hover {
                    background: transparent;
                    color: #000;
                }


                /* Tabs  */
                .search_add .tabs {
                    display: flex;
                    align-items: center;
                }
                .search_add .tabs li {
                    list-style: none;
                    margin-right: 10px;
                    background: transparent;
                    color: #000;
                    border: 1px solid #80808045;
                    text-align: center;
                    padding: 3px 8px;
                    border-radius: 3px;
                    box-shadow: 0 0 20px rgb(0, 0, 0, .1);
                    font-size: 13px;
                    cursor: pointer;
                    transition: .3s linear;
                }
                .search_add .tabs li:hover {
                    background: rgb(67, 89, 143);
                    color: #fff;
                    border: 1px solid rgb(67, 89, 143);
                }
                .search_add .tabs .active {
                    background: rgb(67, 89, 143);
                    color: #fff;
                    border: 1px solid rgb(67, 89, 143);
                }
            </style>

            <div class="search_add">
               
                <input type="text" placeholder="search" id="search">
            </div>

            <!-- Data Table  -->
            <div class="dataTable">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Gender</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody id="hotels">

                    </tbody>
                </table>
            </div>



            <script>

                let fetchAllusers = async (value) => {
                    try {
                        const response = await fetch("<?php echo base_url("Dashboard/userDataSearch") ?>", {
                            method: 'POST',
                            headers: {
                                "Contnet-Type": "application/json"
                            },
                            body: JSON.stringify({
                                value
                            })
                        });

                        const data = await response.json();

                        if (data) {

                           

                            document.getElementById('hotels').innerHTML = '';
                            data.forEach(element => {


                                let card = document.createElement('tr');
                                card.innerHTML = `

                                            <td>${element.id}</td>
                            <td>${element.name}</td>
                            <td>${element.mobile}</td>
                            <td>${element.gender}</td>
                            <td>${element.timestamp.split(' ')[0]}</td>

                                `;

                                document.getElementById('hotels').appendChild(card);
                            });

                        
                        }
                    } catch (error) {
                        console.log(error);
                    }
                }

                fetchAllusers('All');


                document.getElementById('search').addEventListener('keyup', (e) => {
                    let value = e.target.value;


                    if (value.length != 0) {
                        fetchAllusers(value);
                    } else {
                        fetchAllusers('All')
                    }
                })

                // Dashboard Logout Button
                document.getElementById('dashboardLogoutBtn')?.addEventListener('click', async (e) => {
                    e.preventDefault();
                    
                    try {
                        const response = await fetch('<?php echo base_url("User/logout"); ?>');
                        const result = await response.json();
                        
                        if (result.status === 'success') {
                            alert(result.message);
                            window.location.href = '<?php echo base_url(); ?>';
                        }
                    } catch (error) {
                        console.log(error);
                        alert('Logout failed. Please try again.');
                    }
                });
              
            </script>

           
        </aside>

        </header>


        </body>

        </html>