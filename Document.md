# Modules 
 ├── Use Tables (modules)
 ├── 2 categories hai (1 - Sidebar menu, 2 - Sidebar menu ke andar submodule ) 
 ├── Parent Sidebar (Dahboard/Hospital/Laboratory/Payroll/Pharmacy/..)
 ├── Child Module (Payroll(attendance/shift/ticket/meeting), Setting(Customer/Plan/profile/department/..))
 ├── Strueture (id/parent_id/name/slug/..)
 ├── Use (Module ka use Features aur Permissions function me kiya hai)
 └── Subscription ke time par use hoga kiss plan me kya feature hai aur uss feature me kya modules hai



## CUSTOMER SUBSCRIPTION PLAN (AUTHENTICATION)
# Plan, Feature, Feature Plan and Subscription
 └── ye sare table ka use customer ke external authentication ke liye use hota hai, mtlb agar koi customer
       login kar rha hai to ham ye check karenge ki login karne wala customer(ke employee) pass subscription hai ya nahi agar nahi hai to payment gateway par redirect karwa denge, aur agar customer ne subscription liya hai to kon se plan ka subscription liya hai customer ne 

# Plan 
 ├── Use Tables (plans)
 ├── Plan table me plan ka name uska amount aur plan kab start hua aur kab plan expire hoga
 ├── Plan ka use feature_plans aur subscriptions table me hua hai
 └── Plan ka main use subscription ye hai ki customer ne kiss plan ke liye subscription liya hai


# Feature
 ├── Use Tables (features)
 ├── features table me modules ke base par features set karta hu
 └── features ka use plans aur features ka mapp hota hai feature_plans table me, kis plan me kitna feature hai


# Feature Plan
 ├── Use Tables (feature_plans)
 ├── feature_plans table me feature aur plans ki maaping hoti hai
 └── feature_plans me ham ye set karte hai ki kiss plan ke liye kitna feature avalaible hai


# Subscription
 ├── Use Tables (subscriptions)
 ├── subscriptions table (customer_id/plan_id/invoice_no/transaction_id/amount/start_date/end_date)
 ├── customer ne subscription payment kese kiya hai - 1=Razorpay, 2=Stripe, 3=Cash, 4=Bank Transfer, 5=Mango Pay
 ├── customer ne jo subscription liya hai wo payment hua ya nahi - 1=Success, 2=Pending, 3=Failed
 ├── customer plan kab liya tha aur kab wo expire hone wala hai - start_date, end_date
 ├── subscription me customer ki id lete hai, aur plan ki id lete hai.
 ├── subscription lene ke baad invoice_no aur transaction_id bhi set hoti hai
 ├── transaction_id aur invoice_no payment gateway(Razorpay,Stripe) se milega
 └── customer plan kab liya tha aur kab wo expire hone wala hai - start_date, end_date



- modules table (Parent Module and Child Module) - iska use feature aur permission table me kiya hai
- plans table (Ye Master table hai jiska use subscription ke liye hai)

- feature table (isme module wise feature set hota hai jese Laboratory module ka feature (basic,advance))

- feature_plans table me (kiss plan ke kitne feature available hai ye set hota hai)
- subscription table (plan ke base par subsc deside hota hai)
- customers (isme current_plan_id store hota hai, subscription)

- event liserner chalega jo check karega customer ka subscription_end_date agar expied ho gya to customer table me aur customer ke base par users table ke all customer ke employee ka status inactive kar dega automatically users table aur customer table dono jagah par status=inactive






## LOCAL AUTHENTICATION
# ROLE


# PERMISSION
 ├── Use Tables (permissions)
 ├── permissions table me modules table se id lete hai.
 ├── permissions create 2 part me credate hota hai
 ├── 1st - agar sirf parent module chahiye tab child module lene ki jarurat nahi hoti hai
 ├── 2st - kissi parent ki sub module ke liye agar permission create karna hai tab sub module bhi lete hai
 ├── permission create karne ke liye (parent/sub mudule) + permission name (view/create/save/edit/update/delete)
 ├── permission root -- go to setting select permsison tab 
 └── permissions check table ke action column ke sath hota hai.action column auto generated hai permssion name
      + module ko concat kar ke like (module=dashboard, name=create, action=dashboard.create)


# ROLE PERMISSION MAPPING


# USER ROLE MAPPING
- roles table isme all role honge jaha scope=0 and is_system=0 and customer_id=null ka mtlb hai Owner Company ka employee

- permission isme data module table se data aur apna data jayega like(((Laboratory), View Lab, Reports, laboratory.view), ((Laboratory), Create Lab Report, laboratory.create), ((Shifts), Manage Shifts,shift.view))

- role_permission table me mapping hoga roles ka permission ke sath matlab kiss role ko kya kya permission hogi




## Google Apis
- https://maps.googleapis.com/maps/api/js?key=AIzaSyBY5p5e5PtJuJLl_nRpjefL0S094jdhEP8&libraries=places

