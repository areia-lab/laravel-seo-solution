<style>
    .type-option {
        transition: all 0.2s ease;
    }

    .type-option:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Improved input styling */
    input,
    textarea,
    select {
        border: 1px solid #d1d5db !important;
        background-color: white !important;
        color: #111827 !important;
        padding: 0.625rem 1rem !important;
    }

    input:focus,
    textarea:focus,
    select:focus {
        outline: none;
        border-color: transparent !important;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5) !important;
    }

    /* File input styling */
    input[type="file"]::-webkit-file-upload-button {
        background: #eff6ff;
        color: #1d4ed8;
        font-weight: 600;
        border: 0;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        margin-right: 1rem;
        transition: all 0.2s;
    }

    input[type="file"]::-webkit-file-upload-button:hover {
        background: #dbeafe;
    }

    /* Match Select2 to Tailwind input design */
    .select2-container--default .select2-selection--single {
        height: 42px;
        width: 400px;
        border-radius: 0.5rem;
        border: 1px solid #d1d5db;
        padding: 6px 12px;
        background-color: #fff;
        display: flex;
        align-items: center;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #111827;
        font-size: 0.95rem;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 100%;
        right: 10px;
    }

    .select2-dropdown {
        border-radius: 0.5rem;
        border: 1px solid #d1d5db;
    }
</style>
