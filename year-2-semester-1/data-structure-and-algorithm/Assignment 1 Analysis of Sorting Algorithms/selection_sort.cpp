// Improved Bubble Sort
#include <iostream>
using namespace std;

void selectionSort(int data[], int n){
    int temp;
    // Variables to count number of comparison and swaps
    int com = 0, swap = 0;

    for(int last = n-1; last >= 1; --last){
        int largestIndex = 0;

        for(int p = 1; p <=last; ++p){
            com++;
            if(data[p] > data[largestIndex]){
                largestIndex = p;
            }
        }        
        temp = data[largestIndex];
        data[largestIndex] = data[last];
        data[last] = temp;

        // Print array after swap and update variables
        if(largestIndex != last){
            swap++;
            cout << "Element swapped at last = " << last << " and largestIndex = " << largestIndex << "\n";
            for(int i = 0; i < n; i++){
                cout << data[i] << " ";
            }
            cout << "\n\n";
        }
    }

    // Print the comparisons and swaps
    cout << "Selection sort completed...\n"
    << "Comparisons made: " << com << "\n"
    << "Swaps made: " << swap << "\n";
}

int main(){
    int data[] = {95, 88, 75, 70, 60};
    int n = 5;

    selectionSort(data, n);

    cout << "Sorted Array: ";
    for(int i = 0; i < n; i++){
        cout << data[i] << " ";
    }

    return 0;
}