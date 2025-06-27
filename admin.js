// Admin page JavaScript functionality
document.addEventListener('DOMContentLoaded', function() {
  // Tab switching functionality
  const tabLinks = document.querySelectorAll('.tabLink');
  const tabContents = document.querySelectorAll('.tabContent');
  
  if (tabLinks.length > 0) {
    tabLinks.forEach(tabLink => {
      tabLink.addEventListener('click', function() {
        // Remove active class from all tabs
        tabLinks.forEach(link => link.classList.remove('active'));
        tabContents.forEach(content => content.classList.remove('active'));
        
        // Add active class to clicked tab
        this.classList.add('active');
        
        // Show corresponding tab content
        const tabId = this.dataset.tab + 'Tab';
        document.getElementById(tabId).classList.add('active');
      });
    });
  }
  
  // Order search functionality
  const orderSearch = document.getElementById('orderSearch');
  const searchOrderBtn = document.getElementById('searchOrderBtn');
  
  if (searchOrderBtn) {
    searchOrderBtn.addEventListener('click', function() {
      searchOrders(orderSearch.value.trim());
    });
  }
  
  if (orderSearch) {
    orderSearch.addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        searchOrders(this.value.trim());
      }
    });
  }
  
  // Customer search functionality
  const customerSearch = document.getElementById('customerSearch');
  const searchCustomerBtn = document.getElementById('searchCustomerBtn');
  
  if (searchCustomerBtn) {
    searchCustomerBtn.addEventListener('click', function() {
      searchCustomers(customerSearch.value.trim());
    });
  }
  
  if (customerSearch) {
    customerSearch.addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        searchCustomers(this.value.trim());
      }
    });
  }
  
  // Edit order functionality
  const editOrderBtns = document.querySelectorAll('.editOrderBtn');
  const editOrderModal = document.getElementById('editOrderModal');
  const closeEditOrderModal = document.getElementById('closeEditOrderModal');
  const editOrderForm = document.getElementById('editOrderForm');
  
  if (editOrderBtns.length > 0) {
    editOrderBtns.forEach(btn => {
      btn.addEventListener('click', function() {
        const orderId = this.dataset.id;
        const orderData = getOrderData(orderId);
        
        // Populate form with order data
        document.getElementById('edit_order_id').value = orderId;
        document.getElementById('edit_customer_name').value = orderData.customerName;
        document.getElementById('edit_burger_type').value = orderData.burgerType;
        document.getElementById('edit_quantity').value = orderData.quantity;
        document.getElementById('edit_status').value = orderData.status;
        
        // Show modal
        editOrderModal.style.display = 'block';
      });
    });
  }
  
  // Close edit order modal
  if (closeEditOrderModal) {
    closeEditOrderModal.addEventListener('click', function() {
      editOrderModal.style.display = 'none';
    });
  }
  
  // Update order form submission
  if (editOrderForm) {
    editOrderForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Get form values
      const orderId = document.getElementById('edit_order_id').value;
      const burgerType = document.getElementById('edit_burger_type').value;
      const quantity = document.getElementById('edit_quantity').value;
      const status = document.getElementById('edit_status').value;
      
      // Validation
      if (burgerType === '' || quantity === '' || parseInt(quantity) < 1) {
        alert('Please fill all fields correctly');
        return;
      }
      
      // Update order (in a real app, this would update the database)
      updateOrder(orderId, burgerType, quantity, status);
      
      // Close modal
      editOrderModal.style.display = 'none';
    });
  }
  
  // Delete confirmation functionality
  const deleteConfirmModal = document.getElementById('deleteConfirmModal');
  const closeDeleteConfirmModal = document.getElementById('closeDeleteConfirmModal');
  const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
  const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
  const deleteItemId = document.getElementById('delete_item_id');
  const deleteItemType = document.getElementById('delete_item_type');
  
  // Setup delete buttons
  document.addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('deleteBtn')) {
      const id = e.target.dataset.id;
      const type = e.target.dataset.type;
      
      // Set values in modal
      deleteItemId.value = id;
      deleteItemType.value = type;
      
      // Show modal
      deleteConfirmModal.style.display = 'block';
    }
  });
  
  // Close delete confirmation modal
  if (closeDeleteConfirmModal) {
    closeDeleteConfirmModal.addEventListener('click', function() {
      deleteConfirmModal.style.display = 'none';
    });
  }
  
  // Cancel delete
  if (cancelDeleteBtn) {
    cancelDeleteBtn.addEventListener('click', function() {
      deleteConfirmModal.style.display = 'none';
    });
  }
  
  // Confirm delete
  if (confirmDeleteBtn) {
    confirmDeleteBtn.addEventListener('click', function() {
      const id = deleteItemId.value;
      const type = deleteItemType.value;
      
      // Delete item (in a real app, this would delete from the database)
      if (type === 'order') {
        deleteOrder(id);
      } else if (type === 'customer') {
        deleteCustomer(id);
      }
      
      // Close modal
      deleteConfirmModal.style.display = 'none';
    });
  }
  
  // Close modals when clicking outside
  window.addEventListener('click', function(e) {
    if (e.target === editOrderModal) {
      editOrderModal.style.display = 'none';
    }
    if (e.target === deleteConfirmModal) {
      deleteConfirmModal.style.display = 'none';
    }
  });
  
  // Load initial data (in a real app, this would come from the database)
  loadSampleData();
  
  // Helper functions
  function searchOrders(query) {
    // In a real app, this would search the database
    console.log('Searching orders for:', query);
    
    // For demo purposes, just filter the existing rows
    const rows = document.querySelectorAll('#ordersTableBody tr');
    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      if (text.includes(query.toLowerCase())) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }
  
  function searchCustomers(query) {
    // In a real app, this would search the database
    console.log('Searching customers for:', query);
    
    // For demo purposes, just filter the existing rows
    const rows = document.querySelectorAll('#customersTableBody tr');
    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      if (text.includes(query.toLowerCase())) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }
  
  function getOrderData(orderId) {
    // In a real app, this would get data from the database
    // For demo purposes, return dummy data
    return {
      customerName: 'John Doe',
      burgerType: 'Cheese Burger',
      quantity: 2,
      status: 'Pending'
    };
  }
  
  function updateOrder(orderId, burgerType, quantity, status) {
    // In a real app, this would update the database
    console.log('Updating order:', orderId, burgerType, quantity, status);
    
    // For demo purposes, update the table row
    const row = document.querySelector(`#ordersTableBody tr[data-id="${orderId}"]`);
    if (row) {
      row.cells[2].textContent = burgerType;
      row.cells[3].textContent = quantity;
      row.cells[5].textContent = status;
    }
  }
  
  function deleteOrder(orderId) {
    // In a real app, this would delete from the database
    console.log('Deleting order:', orderId);
    
    // For demo purposes, remove the table row
    const row = document.querySelector(`#ordersTableBody tr[data-id="${orderId}"]`);
    if (row) {
      row.remove();
    }
  }
  
  function deleteCustomer(customerId) {
    // In a real app, this would delete from the database
    console.log('Deleting customer:', customerId);
    
    // For demo purposes, remove the table row
    const row = document.querySelector(`#customersTableBody tr[data-id="${customerId}"]`);
    if (row) {
      row.remove();
    }
  }
  
  function loadSampleData() {
    // Load sample orders
    const ordersTableBody = document.getElementById('ordersTableBody');
    if (ordersTableBody) {
      ordersTableBody.innerHTML = `
        <tr data-id="1">
          <td>1</td>
          <td>John Doe</td>
          <td>Cheese Burger</td>
          <td>2</td>
          <td>2025-04-12</td>
          <td>Pending</td>
          <td>
            <button class="actionBtn editOrderBtn" data-id="1"><i class="fas fa-edit"></i></button>
            <button class="actionBtn deleteBtn" data-id="1" data-type="order"><i class="fas fa-trash"></i></button>
          </td>
        </tr>
        <tr data-id="2">
          <td>2</td>
          <td>Jane Smith</td>
          <td>Spicy Burger</td>
          <td>1</td>
          <td>2025-04-12</td>
          <td>Processing</td>
          <td>
            <button class="actionBtn editOrderBtn" data-id="2"><i class="fas fa-edit"></i></button>
            <button class="actionBtn deleteBtn" data-id="2" data-type="order"><i class="fas fa-trash"></i></button>
          </td>
        </tr>
        <tr data-id="3">
          <td>3</td>
          <td>Mike Johnson</td>
          <td>Veggie Burger</td>
          <td>3</td>
          <td>2025-04-11</td>
          <td>Completed</td>
          <td>
            <button class="actionBtn editOrderBtn" data-id="3"><i class="fas fa-edit"></i></button>
            <button class="actionBtn deleteBtn" data-id="3" data-type="order"><i class="fas fa-trash"></i></button>
          </td>
        </tr>
      `;
    }
    
    // Load sample customers
    const customersTableBody = document.getElementById('customersTableBody');
    if (customersTableBody) {
      customersTableBody.innerHTML = `
        <tr data-id="1">
          <td>1</td>
          <td>John Doe</td>
          <td>john@example.com</td>
          <td>1234567890</td>
          <td>2</td>
          <td>
            <button class="actionBtn deleteBtn" data-id="1" data-type="customer"><i class="fas fa-trash"></i></button>
          </td>
        </tr>
        <tr data-id="2">
          <td>2</td>
          <td>Jane Smith</td>
          <td>jane@example.com</td>
          <td>9876543210</td>
          <td>1</td>
          <td>
            <button class="actionBtn deleteBtn" data-id="2" data-type="customer"><i class="fas fa-trash"></i></button>
          </td>
        </tr>
        <tr data-id="3">
          <td>3</td>
          <td>Mike Johnson</td>
          <td>mike@example.com</td>
          <td>5555555555</td>
          <td>3</td>
          <td>
            <button class="actionBtn deleteBtn" data-id="3" data-type="customer"><i class="fas fa-trash"></i></button>
          </td>
        </tr>
      `;
    }
    
    // Add event listeners to the newly created buttons
    const editOrderBtns = document.querySelectorAll('.editOrderBtn');
    editOrderBtns.forEach(btn => {
      btn.addEventListener('click', function() {
        const orderId = this.dataset.id;
        const orderData = getOrderData(orderId);
        
        // Populate form with order data
        document.getElementById('edit_order_id').value = orderId;
        document.getElementById('edit_customer_name').value = orderData.customerName;
        document.getElementById('edit_burger_type').value = orderData.burgerType;
        document.getElementById('edit_quantity').value = orderData.quantity;
        document.getElementById('edit_status').value = orderData.status;
        
        // Show modal
        editOrderModal.style.display = 'block';
      });
    });
  }
});
