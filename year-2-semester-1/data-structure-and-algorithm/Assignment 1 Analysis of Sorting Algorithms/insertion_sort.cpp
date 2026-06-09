// Improved Bubble Sort
#include <iostream>
using namespace std;

void insertionSort(int data[], int n){
    int item;
    int pass, insertIndex;
    // Variables to count number of comparison and swaps
    int com = 0, shift = 0;

    for(pass = 1; pass < n; pass++){
        item = data[pass];
        insertIndex = pass;

        while((insertIndex > 0) && data[insertIndex - 1] > item){
            // Insert the right item
            data[insertIndex] = data[insertIndex - 1];
            insertIndex--;
            com++;
            shift++;

            // Print array after exchange
            cout << "Element shifted at pass = " << pass << " and insertIndex = " << insertIndex << "\n";
            for(int i = 0; i < n; i++){
                cout << data[i] << " ";
            }
            cout << "\n\n";
        }

        if((insertIndex > 0)){
            com++;
        }
        data[insertIndex] = item;

        // Print array after insert and update variables
        if(!(data[insertIndex] == item)){
            shift++;
            cout << "Item " << item << " inserted to insertIndex " << insertIndex << "\n";
            for(int i = 0; i < n; i++){
                cout << data[i] << " ";
            }
            cout << "\n\n";
        }
    }

    // Print the comparisons and swaps
    cout << "Insertion sort completed...\n"
    << "Comparisons made: " << com << "\n"
    << "Shifts made: " << shift << "\n";
}

int main(){
    int data[] = {95, 88, 75, 70, 60};
    int n = 5;

    insertionSort(data, n);

    cout << "Sorted Array: ";
    for(int i = 0; i < n; i++){
        cout << data[i] << " ";
    }

    return 0;
}