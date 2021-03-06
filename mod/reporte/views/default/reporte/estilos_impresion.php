<style type="text/css">

    h2 {
        font-size: 16px;
        text-align:center;
        font-weight: 700;
        padding-bottom: 3px; 
        color:#1896bf;
        border-bottom-color:#1896bf;
        border-bottom-width: 1px;
        border-bottom-style: solid;
        margin-bottom: 10px;
        margin-right:  20px;
    }

    select{
        width: 94%;
        margin-left: 3%;
        font-size: 14px;
        margin-top: 10px;
        padding-top: 5px;
        padding-bottom: 5px;
    }

    div#tabla-datos_filter, dataTables_info{
        display: none !important;
        visibility: hidden;
    }
    table{
        width: 100%;
        margin-top:20px;
    }
    
    table {
        margin: 0 auto;
        width: auto;
        min-width: 70%;
        max-width: 100%;
        overflow: hidden;
        background: #FFF;
        color: #024457;
        border: 1px solid #CCCCCC;
    }

    table tr {
        border: 1px solid #D9E4E6;
        width: auto;
    }

    table tr:nth-child(odd) {
        background-color: #EAF3F3;
    }

    table th {
        display: none;
        border: 1px solid #FFF;
        background-color: #167F92;
        color: #FFF;
        padding: 1em;
    }

    table th:first-child {
        display: table-cell;
        text-align: center;
    }

    table th:nth-child(2) {
        display: table-cell;
    }

    table th:nth-child(2) span {
        display: none;
    }

    table th:nth-child(2):after {
        content: attr(data-th);
    }

    @media (min-width: 480px) {
        table th:nth-child(2) span {
            display: block;
        }

        table th:nth-child(2):after {
            display: none;
        }

    }

    table td {
        display: block;
        word-wrap: break-word;
        width: auto;
    }

    table td:first-child {
        display: table-cell;
        text-align: center;
        border-right: 1px solid #D9E4E6;
    }

    @media (min-width: 480px) {
        table td {
            border: 1px solid #D9E4E6;
        }
    }
    table th, table td {
        text-align: center;
        margin: .5em 1em;
    }
    @media (min-width: 480px) {
        table th, table td {
            display: table-cell;
            padding: 1em;
        }
    }


</style>