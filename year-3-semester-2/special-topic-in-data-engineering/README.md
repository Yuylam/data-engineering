# Special Topic in Data Engineering
This course provides an advanced exploration of emerging concepts, technologies, and current trends in data engineering. It aims to bridge academic knowledge with real-world industry practices through exposure to contemporary tools and industry-driven learning experiences.

## Technologies Involved
![Azure](https://img.shields.io/badge/Azure-0078D4?style=for-the-badge&logo=microsoft-azure&logoColor=white)
![Databricks](https://img.shields.io/badge/Databricks-FF3621?style=for-the-badge&logo=databricks&logoColor=white)
![PowerBI](https://img.shields.io/badge/PowerBI-F2C811?style=for-the-badge&logo=power-bi&logoColor=white)
![PySpark](https://img.shields.io/badge/PySpark-E25A1C?style=for-the-badge&logo=apache-spark&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/postgresql-4169E1?style=for-the-badge&logo=postgresql&logoColor=white)
![metabase](https://img.shields.io/badge/metabase-509EE3?style=for-the-badge&logo=metabase&logoColor=white)
![tensorflow](https://img.shields.io/badge/tensorflow-FF6F00?style=for-the-badge&logo=tensorflow&logoColor=white)
![scikitlearn](https://img.shields.io/badge/scikitlearn-F7931E?style=for-the-badge&logo=scikitlearn&logoColor=white)

## Industry Visits and Talks
- 7th April: Industrial Visit to PPG at Shah Alam
- 28th April: Guest Lecture on Practical Approaches to Enhance Machine Learning Algorithms
- 13th May: Industrial Taslk from iZeno
- 20th May: Industrial Talk by Mr. Zaid

## Assignments
### [Assignment: Academic Writing](/year-3-semester-2/special-topic-in-data-engineering/assignment-academic-writing.pdf)
In this assignment, cloud-based data engineering platforms were examined, particularly, Microsoft Azure. Comparison were also conducted to other major cloud service providers including Amazon Web Sevices and Google Cloud Platform.

### [Tutorial 1 Azure Data Pipeline](/year-3-semester-2/special-topic-in-data-engineering/tutorial1-azure.pdf)
Through this tutorial, Microsoft Azure technologies used to be gigantic to me implemented practically. It gave us a basic understanding of how these technologies work together. 
 
The most challenging part throughout the project was configuring between services. In particular, when ingesting data from on-premise sources to the cloud. As this was the first time using these technologies, there were several settings that had to be configured. While the YouTuber demonstrated the steps seamlessly without issues, a significant amount of time we spent identifying and resolving problems. 
 
Besides, there were challenges mounting Databricks to the data lake storage where hours were spent to solve the problem. Fortunately, my teammate shared her solution as she faced the same  problem. 

I used to prefer solving problems on my own without seeking help from others, but in this case, the issue was resolved quickly after applying my teammate’s code. Moving forward, I will be more open to seeking input from others when facing challenges.

### [Tutorial 2 Apache Spark](/year-3-semester-2/special-topic-in-data-engineering/tutorial2-spark.pdf)
This tutorial provided us with hands-on experience to build an ETL pipeline that takes raw Brazilian school census data and structures it into a Star Schema in PostgreSQL, by using Apache Spark for handling large data.  
 
One of the main challenges encountered during the implementation was when using Spark to read the data. Initially, the code was executed within a Python notebook environment, but the program ran for an exceptionally long time without producing any output. The issue was later identified by executing the program as a Python script, which enabled error messages to be displayed in the terminal. The problem was due to incompatible and missing dependencies. Additionally, the long execution time occurred because the process did not terminate properly after the error had occurred.  
 
By analysing the reference implementation, a better understanding of the data transformation and loading process into PostgreSQL was achieved. Overall, this tutorial provided valuable exposure to Apache Spark and ETL pipeline development

### [Tutorial 3 Image Classification](/year-3-semester-2/special-topic-in-data-engineering/tutorial3-cnn.pdf)
In this tutorial, three models, including an ANN model, a CNN model and an improved CNN model, were built to classify images. The models were trained on the CIFAR-10 training dataset and tested on the test dataset. The results clearly showed that the ANN produced the weakest performance, while the improved CNN model achieved the best results. 
 
Through  this  tutorial,  I  learned  how  these  models  work  and  how  they  perform  image classification step by step. The unexpected challenges are the long training time used in the improved CNN, which took 80 minutes when it was trained. 
 
Another challenge faced is the usage of validation data in the enhanced CNN model. At first, the test data was used as validation data, but considering bias that may occur, the validation was adjusted to be the 20% of the training data. This caused the accuracy to drop. Out of curiosity, a model was also trained without validation and callback, and the results were just different in decimals. 
 
Overall, this tutorial was a valuable learning experience. Future work could involve testing the models on different datasets and further evaluating their performance, as different types of data may be better suited to different models. 

### [Tutorial 4 Agentic AI in Data Engineering](/year-3-semester-2/special-topic-in-data-engineering/tutorial4-express-nexla.pdf)
In this project, an AI platform, Express, was used to build a data pipeline. Data from the Fake Store API were loaded into Express, transformed, and then loaded into a Streamlit dashboard via an API. 
 
Throughout this tutorial, several data platforms that support AI-assisted development, agentic AI, or data pipeline creation were explored. Although only one platform was implemented in this tutorial, it provided exposure to the AI solutions available for data pipeline development and the capabilities offered by these platforms. It also enabled us to explore the potential of AI and how it can assist in software and data development. 
 
Despite  the  simplicity  of  the  pipeline  developed  in  this  tutorial,  several  challenges  were encountered during the implementation process. One of the main challenges was the inability to connect successfully to other services. Express provides integration options with various cloud services, including cloud storage platforms such as Google Drive and Dropbox, as well as data platforms such as Snowflake. However, errors occurred when configuring credentials, and  some  services  required  private  keys  could  not  be  shared.  Express  also  supports destinations  such  as  email,  but  emails  were  not  successfully  sent  after  the  pipeline  was executed. There may have been several factors contributing to these connection failures. As a result, a Streamlit dashboard was used to present the output instead. Consequently, most of the transformations and calculations were shifted to the Streamlit application code. 
 
Future  improvements  could  include  implementing  a  wider  variety  of  transformations  and extending the pipeline to handle more complex datasets and workflows. 
 
Overall,  this  project  provided  exposure  to  the  use  of  AI,  particularly  agentic  AI  in  data pipeline development. It broadened our perspective on the potential of AI and opened up new possibilities for its application beyond the commonly used generative AI. 

### [Tutorial 5 Database and System Design of a Monitoring Dashboard](/year-3-semester-2/special-topic-in-data-engineering/tutorial5-database-design.pdf)
In this tutorial, a data pipeline implemented by others were examined. The data enginneering steps, database design, use case and dashboard were analysed to study and learn the implementation for other case study.

## Project
### [PPG Project: Recoverable Assets & Inventory Risk Management (IRM)](/year-3-semester-2/special-topic-in-data-engineering/ppg-project-report.pdf)
This is a very meaningful project, where real-world data (simplified) were put into use. An end-to-end data pipeline was built from data ingestion till visualisation using Azure Data Factory, Data Lake, Synapse and PowerBI to identify the excess stock, flag write-downs, quantify financial impact, detact stockout risk and trace customer impact.

It was very interesting to figure out the business logics to compute the results and implementing it. However, due to the limitations of Azure Data Factory (ADF) during physical implementation, some computations may not be easily mapped using the low-code environment in (ADF).

Despite the challenges, the pipeline was implemented sucessfully with desirable outcomes.

### Individual Project
WIP