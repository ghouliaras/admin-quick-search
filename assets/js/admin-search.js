jQuery(document).ready(function($) {
    let searchTimeout;
    let selectedIndex = -1;
    let results = [];
    
    // Keyboard shortcut (Ctrl+K or Cmd+K)
    $(document).on('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            openSearchModal();
        }
    });
    
    // Close modal on ESC or click outside
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape') {
            closeSearchModal();
        }
    });
    
    $('#aqs-modal').on('click', function(e) {
        if (e.target.id === 'aqs-modal') {
            closeSearchModal();
        }
    });
    
    // Search input handler
    $('#aqs-search-input').on('input', function() {
        const searchTerm = $(this).val();
        
        clearTimeout(searchTimeout);
        
        if (searchTerm.length < 2) {
            $('#aqs-results').html('');
            return;
        }
        
        searchTimeout = setTimeout(() => {
            performSearch(searchTerm);
        }, 300);
    });
    
    // Keyboard navigation
    $('#aqs-search-input').on('keydown', function(e) {
        const items = $('.aqs-result-item');
        
        if (e.key === 'ArrowDown') {
            e.preventDefault();
            selectedIndex = Math.min(selectedIndex + 1, items.length - 1);
            updateSelection(items);
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            selectedIndex = Math.max(selectedIndex - 1, -1);
            updateSelection(items);
        } else if (e.key === 'Enter' && selectedIndex >= 0) {
            e.preventDefault();
            const url = $(items[selectedIndex]).data('url');
            if (url) {
                window.location.href = url;
            }
        }
    });
    
    function openSearchModal() {
        $('#aqs-modal').addClass('active');
        $('#aqs-search-input').val('').focus();
        $('#aqs-results').html('');
        selectedIndex = -1;
    }
    
    function closeSearchModal() {
        $('#aqs-modal').removeClass('active');
    }
    
    function performSearch(term) {
        $.ajax({
            url: aqs_ajax.url,
            method: 'POST',
            data: {
                action: 'aqs_search',
                search: term,
                nonce: aqs_ajax.nonce
            },
            success: function(response) {
                if (response.success) {
                    displayResults(response.data);
                }
            }
        });
    }
    
    function displayResults(data) {
        let html = '';
        results = [];
        
        if (Object.keys(data).length === 0) {
            html = '<div class="aqs-no-results">No results found</div>';
        } else {
            for (const [type, items] of Object.entries(data)) {
                html += `<div class="aqs-result-group">`;
                html += `<div class="aqs-result-group-title">${type}</div>`;
                
                items.forEach(item => {
                    results.push(item);
                    html += `
                        <div class="aqs-result-item" data-url="${item.url}">
                            <div class="aqs-result-title">${item.title}</div>
                            <div class="aqs-result-meta">
                                <span class="aqs-result-type">${item.type}</span>
                                ${item.status ? `<span class="aqs-result-status">${item.status}</span>` : ''}
                            </div>
                        </div>
                    `;
                });
                
                html += '</div>';
            }
        }
        
        $('#aqs-results').html(html);
        
        // Click handler for results
        $('.aqs-result-item').on('click', function() {
            const url = $(this).data('url');
            if (url) {
                window.location.href = url;
            }
        });
    }
    
    function updateSelection(items) {
        items.removeClass('selected');
        if (selectedIndex >= 0) {
            $(items[selectedIndex]).addClass('selected');
        }
    }
});