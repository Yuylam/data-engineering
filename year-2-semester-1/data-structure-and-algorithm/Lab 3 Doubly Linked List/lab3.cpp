// Group Members: 
// Lam Yoke Yu A23CS0233 10/10
// Goe Jie Ying A23CS0224 9/10
// Teh Ru Qian A23CS0191 9/10
// Afiq Danish A23CS0118 9/10

#include <iostream>
#include <string>
using namespace std;

// Define class Node
class Node {
public:
    string name;
    Node* prev;
    Node* next;
    
    Node(string data) {
        name = data;
        prev = nullptr;
        next = nullptr;
	}
};

// Functions for Doubly Linked List Operations
class DoublyLinkedList {
    Node* head;
    Node* tail;
    
public:
	DoublyLinkedList() { 
        head = nullptr;
        tail = nullptr;
	}
    
    // Task 1: Create the list (given)
    void createList() {
        string names[] = {"Ali", "Baba", "Chan", "Diana", "Ely"};
        for (int i = 0; i < 5; i++) {
            insertAtEnd(names[i]);
        }
    }
    
    // Task 1.1 Helper function to insert at the end
    void insertAtEnd(string name) {
        if(head){ // If the list is not empty
            // Put pointer of new node to current tail
            tail->next = new Node(name);
            // Put pointer of current tail to new node
            tail->next->prev = tail;
            // Change the tail to the new node
            tail = tail->next;
        }
        else{
            head = new Node(name);
            tail = head;
        }
    }

    // Task 2: Count and display nodes
    void countAndDisplay() {
        Node* current = head;
        int count = 0;

        while(current != nullptr){
            count++;
            cout << "Node " << count << ": " << current->name << endl;

            current = current->next;
        }

        cout << "Total Nodes: " << count << endl << endl;
    }

    // Task 3: Delete the last node
    void deleteLastNode() {
        if(head == nullptr){
            // If the list is empty
            cout << "The list is empty\n";
            return;
        }
        else if (head == tail){
            // If there is only one node
            delete head;
            head = nullptr;
            tail = nullptr;
        }
        else{
            Node* temp = tail;
            tail = tail->prev;
            tail->next = nullptr;
            delete temp;
        }
    }

    // Task 4: Insert at the second position
    void insertAtSecond(string name) {
        Node* temp = new Node(name);
        temp->next = head->next;
        temp->prev = head;
        
        head->next = temp;
        temp->next->prev = temp;
    }

    // Display the list
    void displayList() {
        Node* current = head;
        int count = 1;

        while(current != nullptr){
            cout << "Node " << count++ << ": " << current->name << endl;
            current = current->next;
        }
        cout << "\n";
    }
};

int main() {
    DoublyLinkedList dll;

    // Task 1: Create the list
    dll.createList();

    // Task 2: Count and display nodes
    dll.countAndDisplay();

    // Task 3: Delete the last node
    dll.deleteLastNode();
    cout << "List after deleting last node:\n";
    dll.displayList();

    // Task 4: Insert a node at the second position
    dll.insertAtSecond("Alisa");
    cout << "List after inserting 'Alisa' at second position: \n";
    dll.displayList();

    return 0;
}
