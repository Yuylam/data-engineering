#include <iostream>
using namespace std;

int sumUpTo(int n){
    // Base case
    if (n == 1){
        return 1;
    }
    else{
        // Recursive call
        return n + sumUpTo(n-1);
    }
}

int main(){
    int n;
    cin >> n;
    cout << sumUpTo(n);
}