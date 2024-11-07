<style>
    .image-container {
        width: 150px;
        cursor: pointer;
        position: relative;
        border: 3px solid transparent;
        border-radius: 8px;
        overflow: hidden;
    }

    .image-container img {
        width: 150px;
        height: 150px;
        object-fit: cover;
    }

    .image-container.primary {
        border-color: #0d6efd;
    }

    .primary-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #0d6efd;
        color: white;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 12px;
        display: none;
    }

    .image-container.primary .primary-badge {
        display: block;
    }

    .btn-delete {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background: rgba(220, 53, 69, 0.9);
        color: white;
        border: none;
        border-radius: 4px;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .btn-delete:hover {
        background: rgba(220, 53, 69, 1);
    }
</style>
