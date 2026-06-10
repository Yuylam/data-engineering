#include <iostream>
using namespace std;

int orderCount = 0;

class Order {
public:
    int orderID;
    int orderQtt;
    Order* next;
};

class Queue {
public:
    Order* queueHead;
	Order* queueTail;
	
	Queue(){
		queueHead = nullptr;
		queueTail = nullptr;
	}
	
	bool isEmpty() {
	    return queueHead == nullptr;
	}
	
	void addOrder() {
		int quantity;
	    cout << "Enter Order Quantity: ";
	    cin >> quantity;
	
	    // Create a new order
	
	    Order* newOrder = new Order();
	    newOrder->orderID = ++orderCount;
	    newOrder->orderQtt = quantity;
	    newOrder->next = nullptr;
	
	    // If the queue is empty, the new order becomes the head and tail
	
	    if (isEmpty()) {
	        queueHead = newOrder;
	        queueTail = newOrder;
	    } else {
	        // Add the new order to the end of the queue
	        queueTail->next = newOrder;
	        queueTail = newOrder;
	    }
	    
	    cout << "Your order ID is " << queueTail->orderID << endl;	
	    cout << "Order has been added to the queue.\n\n";
	}
	
	void getFront() {
	    if (isEmpty()) {
	        cout << "No orders in the queue.\n";
	
	    } else {
	
	        cout << "Front Order Details: \n";
	        cout << "Order ID: " << queueHead->orderID 
	             << ", Quantity: " << queueHead->orderQtt << endl;
	
	    }
	
	    cout << "\n";
	}
	
	void cancelOrder() {
	    if (isEmpty()) {
	        cout << "There is no order.\n\n";
	        return;
	    }
	
	    Order* current = queueHead;
	    Order* prev = nullptr;
	    int id;
	
	    cout << "Order ID: ";
	    cin >> id;
	
	    while (current) {
	        // If order found
	        if (current->orderID == id) {
	            // If order is the only one in the queue
	            if (prev == nullptr && current->next == nullptr) {
	                queueHead = nullptr;
	                queueTail = nullptr;
	            }
	            // If order is the head of the queue
	            else if (current == queueHead) {
	                queueHead = queueHead->next;
	            }
	            // If order is the tail of the queue
	            else if (current == queueTail) {
	                queueTail = prev;
	                queueTail->next = nullptr;
	            }
	            // If order is in the middle of the queue
	            else {
	                prev->next = current->next;
	            }
	
	            cout << "Order Found.\n"
	                 << "Order ID: " << current->orderID << endl
	                 << "Order Quantity: " << current->orderQtt << endl
	                 << "Cancelling Order...\n\n";
	
	            delete current;
	            return;
	        } else {
	            prev = current;
	            current = current->next;
	        }
	    }
	
	    cout << "Order Not Found.\n\n";
	}

	//display all orders in queue edited
	void displayOrders() {
	    if (!queueHead) { 
	        cout << "No orders in the queue.\n";
	        return; 
	    }
	
	    Order* temp = queueHead;
	    cout << "Current orders in the queue:\n"; 
	    while (temp) { 
	        cout << "Order ID: " << temp->orderID 
	             << ", Quantity: " << temp->orderQtt << endl; 
	        temp = temp->next; 
	    }
	    cout << "\n";
	}
	
	// Notify and remove the front order when it's ready (edited)
	void orderReady() {
	    if (!queueHead) {
	        cout << "No orders to process.\n";
	        return;
	    }
	
	    // Notify about the order that is ready
	    cout << "Order ready: Order ID: " << queueHead->orderID 
	         << ", Quantity: " << queueHead->orderQtt << endl;
	
	    // Delete the front order
	    Order* temp = queueHead;
	    queueHead = queueHead->next;
	
	    if (!queueHead) {
	        queueTail = nullptr;
	    }
	
	    delete temp;
	    cout << "\n";
	}


};



int main() {
	Queue q;
    int choice;

    while (true) {
        cout << "<<<<< Ayam Gunting Viral Ordering System >>>>>\n";
        cout << "1. New Order\n";
        cout << "2. Cancel Order\n";
        cout << "3. Order Ready\n";
        cout << "4. Display Order\n";
        cout << "5. Get First Order\n";
        cout << "6. Exit\n";
        cout << "Enter your choice: ";
        cin >> choice;

        switch (choice) {
            case 1:
                q.addOrder();
                break;
            case 2:
                q.cancelOrder();
                break;
            case 3:
                q.orderReady();
                break;
            case 4:
                q.displayOrders();
                break;
            case 5:
                q.getFront();
                break;
            case 6:
                cout << "Exiting program.\n";
                return 0;
            default:
                cout << "Invalid choice. Please try again.\n";
        }
    }
}
