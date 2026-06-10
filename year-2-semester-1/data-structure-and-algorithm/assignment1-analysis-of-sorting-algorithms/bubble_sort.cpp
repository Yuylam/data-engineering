// Improved Bubble Sort
#include <iostream>
using namespace std;

void bubbleSort(int data[], int n){
    int temp;

    // Variables to count number of comparison and swaps
    int com = 0, swap = 0;

    for(int pass = 1; (pass < n); ++pass){
        for(int x = 0; x < n - pass; ++x){
            com++;
            if(data[x] > data[x+1]){
                // Exchange Items
                swap++;
                temp = data[x];
                data[x] = data[x+1];
                data[x+1] = temp;

                // Print array after swap
                cout << "Element swapped at pass = " << pass << " and x = " << x << "\n";
                for(int i = 0; i < n; i++){
                    cout << data[i] << " ";
                }
                cout << "\n\n";
            }
        }
    }
    // Print the comparisons and swaps
    cout << "Bubble sort completed...\n"
    << "Comparisons made: " << com << "\n"
    << "Swaps made: " << swap << "\n";
}

int main(){
    int data[] = {95, 88, 75, 70, 60};
    int n = 5;

    bubbleSort(data, n);

    cout << "Sorted Array: ";
    for(int i = 0; i < n; i++){
        cout << data[i] << " ";
    }

    return 0;
}