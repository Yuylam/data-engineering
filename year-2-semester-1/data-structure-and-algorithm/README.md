# Data Structure and Algorithm
As a next episode of Programming Technique 2, this course introduces data structure concepts and sorting algorithm using the C++ programming language.

- [Course content](#course-content)
- [Assignments](#assignments)
- [Reflection](#reflection)

## Technology Involved
![C++](https://img.shields.io/badge/c++-00599C?style=for-the-badge&logo=cplusplus&logoColor=white)

## Course content
- Abstract Data Type
- File Operations
- Recursive Algorihtms
- Algorithm Efficiency: Analysis order of magnitude, Big O notation
- Sorting
    - Bubble Sort
    - Selection Sort
    - Insertion Sort
    - Merge Sort
    - Quick Sort
- Searching
    - Sequential Search
    - Binary Search
- Linked List
- Stack
- Queue
- Tree
- Binary Search Tree

## Assignments
### [Lab 1 Simple Calculator with Class Implementation](/year-2-semester-1/data-structure-and-algorithm/lab1-simple-calculator/)
A C++ program that performs basic arithmetic operations on two integers using a `SimpleCalc` class. This lab demonstrates fundamental object-oriented programming concepts such as encapsulation, constructors and member functions.

### [Lab 2 Recursive Call](/year-2-semester-1/data-structure-and-algorithm/lab2-recursive-call/)
A C++ program that computes n^2 using repeated addition. It includes different recursive approaches:
- [Standard recursion method (repeated addition)](/year-2-semester-1/data-structure-and-algorithm/lab2-recursive-call/lab2.1-standard.cpp)
- [Static variable recursion method](/year-2-semester-1/data-structure-and-algorithm/lab2-recursive-call/lab2.1-static.cpp)
- [Recursive sum from 1 to n](/year-2-semester-1/data-structure-and-algorithm/lab2-recursive-call/lab2.2-sum.cpp)

### [Lab 3 Doubly Linked List](/year-2-semester-1/data-structure-and-algorithm/lab3-doubly-linked-list/lab3.cpp)
A C++ program that implements a doubly linked list using dynamic memory allocation. The program demonstrates basic linked list operations such as insertion, deletion, traversal and node counting.

The list is initially created with predefined values, and operations include deleting the last node and inserting a new node at the second position.

### [Assignment 1 Analysis of Sorting Algorithms](/year-2-semester-1/data-structure-and-algorithm/assignment1-analysis-of-sorting-algorithms/assignment1-report.pdf)
Implemented sorting algorithms including [bubble sort](/year-2-semester-1/data-structure-and-algorithm/assignment1-analysis-of-sorting-algorithms/bubble_sort.cpp), [improved bubble sort](/year-2-semester-1/data-structure-and-algorithm/assignment1-analysis-of-sorting-algorithms/improved_bubble_sort.cpp), [insertion sort](/year-2-semester-1/data-structure-and-algorithm/assignment1-analysis-of-sorting-algorithms/insertion_sort.cpp) and [selection_sort](/year-2-semester-1/data-structure-and-algorithm/assignment1-analysis-of-sorting-algorithms/selection_sort.cpp). 

Each algorithm is evaluated based on the number of comparisons and swaps required to sort a dataset of student marks. The results are used to compare the efficiency and performance of each sorting technique.

### [Assignment 2 Stack Application](/year-2-semester-1/data-structure-and-algorithm/assignment2-stack-application/assignment2-report.pdf)
A maze solving program using a stack and backtracking algorithm to find a valid path from start to end. The path is tracked using coordinates and movement directions (up, right, down, left). Implemented in both [array-based](/year-2-semester-1/data-structure-and-algorithm/assignment2-stack-application/array-based.cpp) and [pointer-based](/year-2-semester-1/data-structure-and-algorithm/assignment2-stack-application/pointer-based.cpp) stacks, with identical logic but different underlying implementations.

### [Project: Ayam Gunting Viral Ordering System using Queue](/year-2-semester-1/data-structure-and-algorithm/mini-project/mini-project-report.pdf)
This [program](/year-2-semester-1/data-structure-and-algorithm/mini-project/miniproject.cpp) simulates a simple ordering system using a queue data structure (FIFO). 
Orders are stored in a pointer-based linked list implementation of a queue.

Each order contains an order ID and quantity. The system allows users to:
- Add a new order (enqueue)
- Cancel an existing order by ID
- Process the next order (dequeue)
- View the front order
- Display all orders in the queue

The project demonstrates the use of dynamic memory allocation and linked list operations to implement a queue in C++.

## Reflection
The course was very interesting and engaging. As someone interested in competitive programming (though not good at it), I found it especially enjoyable to study different algorithms and understand how they work in practice.

Through comparing various algorithms, I gained a deeper appreciation for the importance of optimisation. Efficient algorithms help reduce both execution time and memory usage, which directly impacts computational resources such as CPU and RAM.

Overall, this course strengthened my understanding of data structures and algorithms and highlighted their importance in writing efficient and scalable programs.